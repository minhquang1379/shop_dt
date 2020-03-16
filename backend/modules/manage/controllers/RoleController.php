<?php

namespace backend\modules\manage\controllers;

use backend\components\MyController;
use backend\components\UtilAuthClass;
use backend\components\UtilClass;
use Yii;
use backend\models\AuthItem;
use backend\modules\manage\models\AuthItemSearch;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use function Sodium\add;

/**
 * RoleController implements the CRUD actions for AuthItem model.
 */
class RoleController extends MyController
{
    public $itemAction;
    public $roleAction;
    public $assignAction;
    public $authorRoles;
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $util = new UtilClass();
        $this->itemAction = $util->getAction('backend\modules\manage.ItemController');
        $this->roleAction = $util->getAction('backend\modules\manage.RoleController');
        $this->assignAction = $util->getAction('backend\modules\authorization.AssignmentController');
        $this->authorRoles = $util->getAction('backend\modules\authorization.RolesController');
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),[
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);
    }

    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $auth = Yii::$app->authManager;
        $childRole = $auth->getChildren($model->primaryKey);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'itemAction'=>$this->itemAction,
            'roleAction'=>$this->roleAction,
            'assignAction'=>$this->assignAction,
            'authorRoles'=>$this->authorRoles,
            'childRole'=>$childRole,
        ]);
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItem();
        if ($model->load(Yii::$app->request->post()) ) {
            $model->type = 1;
            $model->rule_name = null;
            $model->created_at = time();
            if(!$model->description){
                $model->description = $model->name;
            }

            $transaction = AuthItem::getDb()->beginTransaction();
            try {
                if($model->save()){
                    $post = Yii::$app->request->post();
                    $util = new UtilAuthClass();
                    if( isset($post['Item'])){
                        $util->createAction('backend\modules\manage','Item',$post['Item'],$model->name);
                    }
                    if( isset($post['Role'])){
                        $util->createAction('backend\modules\manage','Role',$post['Role'],$model->name);
                    }
                    if(isset($post['Assignment'])){
                        $util->createAction('backend\modules\authorization','Assignment',$post['Assignment'],$model->name);
                    }
                    if(isset($post['Roles'])){
                        $util->createAction('backend\modules\authorization','Roles',$post['Roles'],$model->name);
                    }
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->name]);
                }
            }catch (Exception $exception){
                $transaction->rollBack();
               Yii::error($exception->getMessage());
            }


        }

        return $this->render('create', [
            'model' => $model,
            'itemAction'=>$this->itemAction,
            'roleAction'=>$this->roleAction,
            'assignAction'=>$this->assignAction,
            'authorRoles'=>$this->authorRoles,
        ]);
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $auth = Yii::$app->authManager;
        if ($model->load(Yii::$app->request->post())) {
            $model->updated_at = time();
            if($model->save()){
                $post = Yii::$app->request->post();
                $array = ['Item','Role'];
                $utilAuth = new UtilAuthClass();
                $moduleId = 'backend\modules\manage';
                foreach($array as $item){
                    if(isset( $post[$item])){
                        $utilAuth->changeAction($moduleId, $item, $post[$item],$model->name);
                    }else{
                        $utilAuth->changeAction($moduleId, $item,[],$model->name);
                    }
                }
                $array1 =['Assignment', 'Roles'];
                $moduleId = 'backend\modules\authorization';
                foreach ($array1 as $item){
                    if(isset($post[$item])){
                        $utilAuth->changeAction($moduleId, $item, $post[$item],$model->name);
                    }else{
                        $utilAuth->changeAction($moduleId, $item, [],$model->name);
                    }
                }


                return $this->redirect(['view', 'id' => $model->name]);
            }
        }
        $childRole = $auth->getChildren($model->primaryKey);
        return $this->render('update', [
            'model' => $model,
            'itemAction'=>$this->itemAction,
            'roleAction'=>$this->roleAction,
            'assignAction'=>$this->assignAction,
            'authorRoles'=>$this->authorRoles,
            'chileRole'=>$childRole,
        ]);
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

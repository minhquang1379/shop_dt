<?php

namespace backend\modules\manage\controllers;

use backend\components\MyController;
use backend\components\UtilClass;
use frontend\controllers\SiteController;
use phpDocumentor\Reflection\Types\Parent_;
use Yii;
use backend\modules\manage\models\ManageController;
use backend\modules\manage\models\itemSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ItemController implements the CRUD actions for ManageController model.
 */
class ItemController extends MyController
{
    public $data;
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $util = new UtilClass();
        $this->data = $util->getRoutes();
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return ArrayHelper::merge( parent::behaviors() ,[
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);
    }

    /**
     * Lists all ManageController models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new itemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ManageController model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ManageController model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ManageController();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $post = Yii::$app->request->post();
            $name = $post['ManageController']['controller_id'];
            $array = explode('.',$name);
            $model->controller_id = $array[1];
            $model->module_name = str_replace('/','\\',$model->module_name);
            try {
                $class = new \ReflectionClass($model->module_name.'\\controllers\\'.$model->controller_id);
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }catch (\Exception $exception){
                Yii::$app->session->setFlash('error','Controller not found');
            }
        }
        return $this->render('create', [
            'model' => $model,
            'data'=>$this->data,
        ]);
    }

    /**
     * Updates an existing ManageController model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $post = Yii::$app->request->post();
            $name = $post['ManageController']['controller_id'];
            $array = explode('.',$name);
            $model->controller_id = $array[1];
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'data'=>$this->data,
        ]);
    }

    /**
     * Deletes an existing ManageController model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $transaction = ManageController::getDb()->beginTransaction();
        try {
            $auth = Yii::$app->authManager;
            $util = new UtilClass();
            $actions = $util->getAction($model->module_name.'.'.$model->controller_id);
            $controllerId = str_replace('Controller','',$model->controller_id);
            foreach ($actions as $action){
                if(($permission = $auth->getPermission($model->module_name.'-'.$controllerId.'-'.$action)) != null)
                    $auth->remove($permission);
            }

            $model->delete();
            $transaction->commit();
        }catch (\Exception $exception){
            $transaction->rollBack();
           throw $exception;
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the ManageController model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ManageController the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ManageController::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionAjax(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax){
            $str = Yii::$app->request->get('str');
            $array = explode('.',$str);
            return [
                'alias'=>$array[1],
                'modules'=>$array[0],
            ];
        }
        return '';
    }
}

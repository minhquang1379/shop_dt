<?php

namespace backend\modules\authorization\controllers;

use backend\components\MyController;
use Cassandra\Time;
use frontend\models\SignupForm;
use Yii;
use common\models\User;
use backend\modules\authorization\models\UserSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends MyController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $auth = Yii::$app->authManager;
        $myRoles = $auth->getRolesByUser($id);
        $roles = $auth->getRoles();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'myRoles'=>$myRoles,
            'roles'=>$roles,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SignupForm();
        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();
        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->getDb()->beginTransaction();
            try {
                $model->signup();
                $post = Yii::$app->request->post();
                $auth = Yii::$app->authManager;
                if(isset($post['roles'])){
                    foreach ($post['roles'] as $postRole){
                        $role = $auth->getRole($postRole);
                        $auth->assign($role, $model->id);
                    }
                }

                $transaction->commit();
            }catch (\Exception $exception){
                $transaction->rollBack();
                throw $exception;
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'roles'=>$roles,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $auth = Yii::$app->authManager;
        $myRoles = $auth->getRolesByUser($id);
        $roles = $auth->getRoles();
        $post = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            foreach ($roles as $role){

                if(isset($post['roles']) && in_array($role->name, $post['roles'])){
                    if( isset($myRoles) && !in_array($role, $myRoles)){
                        $auth->assign($role, $id);
                    }
                    if(!isset($myRoles)){
                        $auth->assign($role, $id);
                    }
                }else{
                    if(array_search($role, $myRoles)){
                        $auth->revoke($role, $id);
                    }
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'myRoles'=>$myRoles,
            'roles'=>$roles,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->id == $id){
            Yii::$app->session->setFlash('error','cannot remove, This is your account');
        }else{
            $transaction = Yii::$app->getDb()->beginTransaction();
            try {

                $auth = Yii::$app->authManager;
                $roles =  $auth->getRolesByUser($id);
                foreach ($roles as $role ){
                    $auth->revoke($role, $id);
                }
                $this->findModel($id)->delete();
                $transaction->commit();

            }catch (\Exception $exception){
                $transaction->rollBack();
                throw $exception;
            }


        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

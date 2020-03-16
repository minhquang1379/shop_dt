<?php

namespace backend\modules\authorization\controllers;

use backend\components\MyController;
use backend\components\UtilAuthClass;
use backend\components\UtilClass;
use phpDocumentor\Reflection\Types\Parent_;
use Yii;
use backend\modules\authorization\models\ManageController;
use backend\modules\authorization\models\ManageControllerSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AssignmentController implements the CRUD actions for ManageController model.
 */
class AssignmentController extends MyController
{
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
     * Lists all ManageController models.
     * @return mixed
     */
    /**
     * Displays a single ManageController model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $role)
    {
        $util = new UtilClass();
        $controller = ManageController::findOne($id);
        $actions = $util->getAction($controller->module_name.'.'.$controller->controller_id);
        $auth = Yii::$app->authManager;
        $childRole = $auth->getChildren($role);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'actions'=>$actions,
            'childRole'=>$childRole,
        ]);
    }

    /**
     * Creates a new ManageController model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    /**
     * Updates an existing ManageController model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $role)
    {
        if(Yii::$app->request->isPost && isset($id) && isset($role)){
            $model = $this->findModel($id);
            $post = Yii::$app->request->post();
                $util = new UtilClass();
                $utilAuth = new UtilAuthClass();
                $auth = Yii::$app->authManager;
                $role = $auth->getRole($role);
                $controllerId = str_replace('Controller','',$model->controller_id);

                if(isset($post['action'])){
                    $utilAuth->changeAction($model->module_name,$controllerId,$post['action'],$role->name);
                }else{
                    $utilAuth->changeAction($model->module_name,$controllerId,[],$role->name);
                }

                return $this->redirect(Yii::$app->request->referrer);
            }

    }

    /**
     * Deletes an existing ManageController model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

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
}

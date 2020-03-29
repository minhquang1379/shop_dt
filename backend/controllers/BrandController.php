<?php

namespace backend\controllers;

use backend\components\MyController;
use Yii;
use backend\models\Brand;
use backend\models\BrandSearch;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BrandController implements the CRUD actions for Brand model.
 */
class BrandController extends Controller
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
     * Lists all Brand models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BrandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Brand model.
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
     * Creates a new Brand model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Brand();

        //check Post Request
        if(Yii::$app->request->isPost){
            //get scenario of Brand model
            $model->scenario = Brand::SCENARIO_CREAT;
            //load post to model
            $model->load(Yii::$app->request->post());
            //Get  object image by uploadFile
            $model->image = UploadedFile::getInstance($model,'image');
            //Check validate for models
            if($model->validate()){
                //upload image and check
                if($model->uploadImage()){
                    $model->created_at = time();
                    $model->created_by = Yii::$app->user->getId();
                    if($model->save(false)){
                        // return to view when success
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
        }
        //return create brand view
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Brand model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        //find model by id
        $model = $this->findModel($id);
        //check post request
        if(yii::$app->request->isPost){
            //get scenario of update Brand model
            $model->scenario = Brand::SCENARIO_UPDATE;
            //old $image
            $image = $model->image;
            //load post to model
            $model->load(Yii::$app->request->post());
            //get image from uploadFile
            $model->image = UploadedFile::getInstance($model,'image');
            //check validate of Brand model
            if($model->validate()){
                //check image != null
                // uploadImage return true or false
                //return false => $model->image = oldImage
                if(!$model->uploadImage()){
                    $model->image = $image; // set to old image
                }
                $model->updated_by = Yii::$app->user->getId();
                $model->updated_at = time();
                //save and not check validate
                if($model->save(false)){
                    //return to view of brand model
                    return $this->render('view',['model'=>$model]);
                }
            }
        }
        //return update view
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Brand model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if(isset($model->image)){
            unlink('upload/brand/'.$model->image);
        }
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Brand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Brand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Brand::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace backend\controllers;

use Yii;
use backend\models\Slider;
use backend\models\SliderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SliderController implements the CRUD actions for Slider model.
 */
class SliderController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Slider models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SliderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Slider model.
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
     * Creates a new Slider model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Slider();
        //check if request is post
        if(Yii::$app->request->isPost){
            //get scenarios of slider model
            $model->scenario = Slider::SCENARIO_CREATE;
            //load post to model
            $model->load(Yii::$app->request->post());
            //load image by uploadFiles
            $model->image = UploadedFile::getInstance($model,'image');
            //check validate model
            if($model->validate()){
                //upload and check image
                //return true if upload success
                if($model->uploadImage()){
                    $model->created_at = time();
                    $model->created_by = Yii::$app->user->getId();
                    //save not validate
                    if($model->save(false)){
                        //return view if success
                        return $this->redirect(['view','id'=>$model->id]);
                    }
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Slider model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //check if request is post
        if(Yii::$app->request->isPost){
            //get scenarios of slider model
            $model->scenario = Slider::SCENARIO_UPDATE;
            //get old image
            $image = $model->image;
            //load post to model
            $model->load(Yii::$app->request->post());
            //load image by uploadFile
            $model->image = UploadedFile::getInstance($model,'image');
            //check validate model
            if($model->validate()){
                //uploadImage if false
                if(!$model->uploadImage()){
                    //set $model->image to old images
                    $model->image = $image;
                }
                $model->updated_at = time();
                $model->updated_by = Yii::$app->user->getId();
                //save not validate
                if($model->save(false)){
                    //return to view
                    return $this->redirect(['view','id'=>$model->id]);
                }
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Slider model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->image){
            unlink('upload/slider/'.$model->image);
        }
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Slider model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Slider the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Slider::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

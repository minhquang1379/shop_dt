<?php

namespace backend\controllers;

use backend\components\MyController;
use backend\models\UploadForm;
use Yii;
use backend\models\Post;
use backend\models\PostSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends MyController
{
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return ArrayHelper::merge( parent::behaviors(),[
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
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
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        //check is post request
        if(Yii::$app->request->isPost){
            //get scenarios of post model
            $model->scenario = Post::SCENARIO_CREATE;
            //load post to model
            $model->load(Yii::$app->request->post());
            //get image by uploadFile
            $model->thumbnail = UploadedFile::getInstance($model,'thumbnail');
            //check validate for post model scenarios create
            if($model->validate()){
                //upload image thumbnail by uploadImage
                //return true if upload success
                if($model->uploadImage()){
                    $model->created_by = Yii::$app->user->getId();
                    $model->created_at = time();
                    $model->like = 0;
                    $model->views = 0;
                    //save with not validate model again
                    if($model->save(false)){
                        //return to view if success
                        return $this->render('view',['model'=>$model]);
                    }
                }
            }
        }
        //return to create view
         return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //check if post request
        if(Yii::$app->request->isPost){
            //get Scenarios update of post model
            $model->scenario = Post::SCENARIO_UPDATE;
            //get old thumbnail image
            $image = $model->thumbnail;
            //load post to model
            $model->load(Yii::$app->request->post());
            //get image  thumbnail by UploadFile
            $model->thumbnail = UploadedFile::getInstance($model,'thumbnail');
            //upload Image by uploadImage
            //return boolean
            //if false => set $model->image = oldImage
            if(!$model->uploadImage()){
                //set model->image to old image
                $model->thumbnail = $image;
            }
            $model->updated_at = time();
            $model->updated_by = Yii::$app->user->getId();
            //save not check validate
            if($model->save(false)){
                //return to view when success
                return $this->render('view',['model'=>$model]);
            }
        }
        //return update view
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if(isset($model->thumbnail)){
            unlink('upload/post/'.$model->thumbnail);
        }

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}

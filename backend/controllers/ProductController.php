<?php

namespace backend\controllers;

use backend\components\MyController;
use Yii;
use backend\models\Product;
use backend\models\ProductSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends MyController
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        //set default for product in stock is 0
        $model->inStock = 0;
        //set scenario for product
        $model->scenario = Product::SCENARIO_CREATE;
        //check if request is post
        if(Yii::$app->request->isPost){
            //load post to model
            $model->load(Yii::$app->request->post());
            //get image to model by uploadFile function
            $model->image = UploadedFile::getInstance($model,'image');
            //check if validate rule of product model
            if($model->validate()){
                //upload image and check by function uploadImage of product
                if($model->uploadImage()){
                    $model->created_by = Yii::$app->user->id;
                    $model->created_at = time();
                    $model->inCart = 0;
                    $model->inOrder = 0;
                    //save with none validate
                    if($model->save(false)){
                        //return to view by model->id
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
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        //find model by id
        $model = $this->findModel($id);
        //get scenario of product model
        $model->scenario = Product::SCENARIO_UPDATE;
        //check request is post
        if(Yii::$app->request->isPost){
            //get old image of model
            $image = $model->image;
            //load post to model
            $model->load(Yii::$app->request->post());
            //set image by uploadFile
            $model->image = UploadedFile::getInstance($model,'image');
            //check if validate product model
            if($model->validate()){
                //upload image by uploadImage
                //if false set $model-image to old image
                if(!$model->uploadImage()){
                   $model->image = $image;
                }
                $model->updated_by = Yii::$app->user->id;
                $model->updated_at = time();
                //save not validate
                if($model->save(false)){
                    return $this->redirect(['view','id'=>$model->id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if(isset($model->image))
        unlink('upload/product/'.$model->image);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

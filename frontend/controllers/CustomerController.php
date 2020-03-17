<?php


namespace frontend\controllers;


use backend\models\Customer;
use common\models\User;
use frontend\models\ChangePassword;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;

class CustomerController extends  Controller
{
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [
                        'actions'=>['index','create','update','password'],
                        'allow'=>true,
                        'roles'=>['@'],
                    ]
                ]
            ]
        ];
    }

    public function actionIndex(){
        $model = Customer::findOne(Yii::$app->user->getId());
        return $this->render('index',[
            'model'=>$model,
        ]);
    }
    public function actionCreate(){
        $model = Customer::findOne(['userId'=>Yii::$app->user->getId()]);
        if($model){
            return $this->redirect(['customer/index']);
        }
        $model = new Customer();
        if(Yii::$app->request->isPost){
            $model->scenario = Customer::SCENARIO_CREATE;
            $model->load(Yii::$app->request->post());
            $model->image = UploadedFile::getInstance($model,'image');
            if($model->validate()){
                if($model->uploadImage()){
                    $model->create_at = time();
                    $model->userId = Yii::$app->user->getId();
                    if($model->save(false)){
                        return $this->redirect(['customer/index']);
                    }
                }
            }
        }
        return $this->render('create',[
            'model'=>$model,
        ]);
    }
    public function actionUpdate(){
        $model = Customer::findOne(['userId'=>Yii::$app->user->getId()]);
        if(Yii::$app->request->isPost){
            $model->scenario = Customer::SCENARIO_UPDATE;
            $oldImage = $model->image;
            $model->load(Yii::$app->request->post());
            $model->image = UploadedFile::getInstance($model, 'image');
           if($model->validate()){
               if(!$model->uploadImage()){
                    $model->image = $oldImage;
               }
               $model->updated_at = time();
               if($model->save(false)){
                   return $this->redirect(['customer/index']);
               }
           }
        }
        return $this->render('update',[
            'model'=>$model,
        ]);
    }
    public function actionPassword(){
        $model = new ChangePassword();
        if(Yii::$app->request->isPost){
            if( $model->load(Yii::$app->request->post()) && $model->validate()){
                $user = User::findOne(['id'=>Yii::$app->user->getId()]);
                $hash = Yii::$app->getSecurity()->generatePasswordHash($model->newPassword);
                $user->password_hash = $hash;
                if($user->save(false)){
                    Yii::$app->session->setFlash('success','Change password success');
                    return $this->redirect(['customer/index']);
                }
            }
        }
        return $this->render('password',[
            'model'=>$model,
        ]);
    }
}
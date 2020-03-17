<?php


namespace frontend\controllers;


use backend\models\Order;
use backend\models\OrderDetail;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class OrderController extends Controller
{
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    [
                        'actions'=>['index','detail','delete','status'],
                        'allow'=>true,
                        'roles'=>['@'],
                    ],
                ]
            ]
        ];
    }

    public function actionIndex(){
        $orders = Order::find()->where(['userId'=>Yii::$app->user->getId()])->andWhere(['!=','status',4])->all();
        return $this->render('index',[
            'orders'=>$orders,
        ]);
    }
    public function actionStatus($id){
        if(Yii::$app->request->isGet){
            $model = Order::findOne(['id'=>$id]);
            if($model->status == 1){
                $model->status = 2;
            }if($model->status == 2){
                $model->status = 3;
            }
            $model->save(false);

            return $this->redirect(['order/index']);
        }
    }
    public function actionDelete($id){
        if(Yii::$app->request->isGet){
            $model = Order::findOne(['id'=>$id]);
            if($model->status == 3){
                $model->status = 4;
            }
            $model->save(false);
            return $this->redirect(['order/index']);
        }
    }
    public function actionDetail($id){
        $order = Order::findOne(['id'=>$id]);
        $orderDetails = OrderDetail::find()->where(['orderId'=>$id])->all();

        return $this->render('detail',[
            'order'=>$order,
            'orderDetails'=>$orderDetails,
        ]);
    }
}
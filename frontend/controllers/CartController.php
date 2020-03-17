<?php


namespace frontend\controllers;


use backend\models\Cartitems;
use backend\models\Customer;
use backend\models\Order;
use backend\models\OrderDetail;
use backend\models\Product;
use common\models\User;
use devanych\cart\CartItem;
use Yii;
use yii\db\Exception;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Request;

class CartController extends Controller
{
    public function actionIndex(){

        $cart = \Yii::$app->cart;
        $productInCart = $cart->getItems();
        return $this->render('index',[
            'productInCart'=>$productInCart,
        ]);
    }
    public function actionAdd($id, $quantity = 1){
        $cart = \Yii::$app->cart;
        $product = Product::findOne($id);
        $cart->add($product, $quantity);
        $product->inCart += $quantity;
        $product->save(false);
        \Yii::$app->session->setFlash('success','add '.$product->name.' successfully');
        return $this->redirect(['cart/index']);
    }
    public function actionDelete($id){
        if(!\Yii::$app->user->isGuest){
            $cartItem = Cartitems::findOne(['productId'=>$id]);
            $product = Product::findOne(['id'=>$id]);
            if($cartItem){
                $product->inCart -= $cartItem->getQuantity();
                $product->save(false);
                $cartItem->delete();
            }
        }
        $cart = \Yii::$app->cart;
        $product = Product::findOne($id);
        $cart->remove($id);
        \Yii::$app->session->setFlash('success','remove '.$product->name.' successful');
        return $this->redirect(['cart/index']);
    }
    public function actionUpdate(){
        $get = \Yii::$app->request->get();
        $quantity = $get['quantity'];
        $productIDs = $get['productId'];
        $oldQuantitys = $get['oldQuantity'];
        if(count($quantity) == count($productIDs)){
            $cart = \Yii::$app->cart;
            for ($i = 0; $i < count($quantity); $i++){
                $cartItem = $cart->getItem($productIDs[$i]);
                $product = Product::findOne(['id'=>$productIDs[$i]]);
                if($cartItem){
                    if($quantity[$i] == 0){
                        $item = Cartitems::findOne(['productId'=>$productIDs[$i],'userId'=>\Yii::$app->user->getId()]);
                        if($item){
                            $product->inCart -= $oldQuantitys[$i];
                            $item->delete();
                        }
                        $cart->remove($productIDs[$i]);
                    }
                    if($cartItem->getQuantity() != $quantity[$i]) {
                        $product->inCart -= $oldQuantitys[$i];
                        $product->inCart += $quantity[$i];

                        $cartItem->setQuantity($quantity[$i]);
                    }
                    $product->save(false);
                }
            }
            \Yii::$app->session->setFlash('success','update cart successful');
            return $this->redirect(['cart/index']);
        }
        \Yii::$app->session->setFlash('danger','update cart unsuccessful');
        return $this->redirect(['cart/index']);
    }
    public function actionCheckout(){
        if(\Yii::$app->user->isGuest){
            \Yii::$app->session->setFlash('danger','Please login to checkout your cart');
            return $this->redirect(['site/login']);
        }
        $model = new Order();
        $cart = \Yii::$app->cart;
        $model->total = $cart->getTotalCost();
        $model->userId = \Yii::$app->user->getId();
        $model->status = 1;
        $customer = Customer::findOne(['userId'=>\Yii::$app->user->getId()]);
        $cartItems = $cart->getItems();
        if($customer){
            $model->receive_name = $customer->name;
            $model->phone = $customer->phone;
            $model->address = $customer->address;
        }
        if(\Yii::$app->request->isPost){
            if($model->load(\Yii::$app->request->post()) && $model->validate()){
                $model->create_at = time();
                $transaction = \Yii::$app->getDb()->beginTransaction();
                try {
                    if($model->save(false)){
                        foreach ($cartItems as $cartItem){
                            $orderDetail = new OrderDetail();
                            $orderDetail->orderId = $model->id;
                            $orderDetail->productId  = $cartItem->getId();
                            $orderDetail->quantity = $cartItem->getQuantity();
                            $orderDetail->price = $cartItem->getPrice();
                            if($orderDetail->save(false)){
                                $item = Cartitems::findOne(['productId'=>$cartItem->getId(),'userId'=>\Yii::$app->user->getId()]);
                                if($item){
                                    $item->delete();
                                }
                            }
                        }
                        $model->sendMail();
                        $cart->clear();
                        $transaction->commit();
                        return $this->redirect(['order/index']);
                    }
                }catch (Exception $exception){
                    $transaction->rollBack();
                    throw $exception;
                }

            }
        }
        return $this->render('checkout',[
            'cartItems'=>$cartItems,
            'model'=>$model,
        ]);
    }
}
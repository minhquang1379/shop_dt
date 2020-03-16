<?php


namespace frontend\controllers;


use backend\models\Product;
use yii\helpers\Url;
use yii\web\Controller;

class ProductController extends Controller
{

    public function actionIndex($id){
        $product = $this->findModel($id);
        if($product){
            $productInCate = Product::find()->where(['categoryId'=>$product->categoryId])->andwhere(['!=','id',$product->id])->limit(4)->all();
            return $this->render('index',[
                'product'=>$product,
                'productInCate'=>$productInCate,
            ]);
        }
        return $this->redirect(['category/index']);
    }
    public function findModel($id){
        return Product::findOne($id);
    }
}
<?php


namespace frontend\controllers;


use backend\models\Category;
use backend\models\Product;
use frontend\components\BaseController;
use yii\web\Controller;

class CategoryController extends Controller
{
    public function actionIndex($id = 0){
        $categories = new Category();
        $products = Product::find()->orderBy('id','desc')->all();
        if($id){
            $category = Category::findOne($id);
            return $this->render('index',[
                'categories'=> $categories,
                'products'=>$category->products,
                'category'=>$category,
            ]);
        }
        return $this->render('index',[
            'categories'=> $categories,
            'products'=>$products,
        ]);
    }
}
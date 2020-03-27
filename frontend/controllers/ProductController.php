<?php


namespace frontend\controllers;


use backend\models\Brand;
use backend\models\Category;
use backend\models\Post;
use backend\models\Product;
use backend\models\Supplier;
use yii\data\Pagination;
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
    public function actionSearch(){
        $get = \Yii::$app->request->get();
        $text = $get['text'];
        $query =  Product::find()
            ->where(['like','name',$text]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount'=>$count,'pageSize'=>12]);
        $products = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $categories = Category::find()->select(['id','name'])->all();
        $suppliers = Supplier::find()->select(['id','name'])->all();
        $brands = Brand::find()->select(['id','name'])->all();
        return $this->render('search',[
            'products'=> $products,
            'text'=>$text,
            'categories'=>$categories,
            'brands'=>$brands,
            'suppliers'=>$suppliers,
            'pagination'=>$pagination,
        ]);
    }
}
<?php


namespace frontend\controllers;


use backend\models\Post;
use frontend\components\BaseController;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class BlogController extends BaseController
{

    public function actionIndex(){
        $query = Post::find()->orderBy(['id'=>SORT_DESC]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount'=>$count,'pageSize'=>12]);

        $blogs = $query->offset($pagination->offset)
                        ->limit($pagination->limit)
                        ->all();

        return $this->render('index',[
            'blogs'=>$blogs,
            'pagination'=>$pagination,
        ]);
    }
    public function actionView($id){
        $model = $this->findModel($id);
        $model->upView();
        return $this->render('view',['model'=>$model]);
    }
    public function findModel($id){
        return Post::findOne($id);
    }
    
}
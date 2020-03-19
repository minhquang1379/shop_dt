<?php


namespace frontend\controllers;


use backend\models\CommentBlog;
use backend\models\Customer;
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
        $count = CommentBlog::find()
            ->where(['blogId'=>$id])
            ->andWhere(['parentId'=>null])
            ->count();
        $comments = CommentBlog::find()
            ->where(['blogId'=>$id])
            ->andWhere(['parentId'=>null])
            ->offset($count - 5)
            ->limit(5)
            ->all();
        $display = 5;
        $userInfo = Customer::findOne(['userId'=>\Yii::$app->user->getId()]);
        return $this->render('view',[
            'model'=>$model,
            'comments'=>$comments,
            'userInfo'=>$userInfo,
            'count' => $count - $display,
            'display'=>$display,
        ]);
    }
    public function findModel($id){
        return Post::findOne($id);
    }
    
}
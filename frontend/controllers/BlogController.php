<?php


namespace frontend\controllers;


use backend\models\CommentBlog;
use backend\models\Customer;
use backend\models\LikeTable;
use backend\models\Post;
use frontend\components\BaseController;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\Response;

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
        $likes = LikeTable::find()->where(['postId'=>$id])->count();
        $is_like = null;
        if($likes != 0){
            $is_like = LikeTable::find()->where(['postId'=>$id])->andWhere(['userId'=>\Yii::$app->user->id])->count();
        }
        return $this->render('view',[
            'model'=>$model,
            'comments'=>$comments,
            'userInfo'=>$userInfo,
            'count' => $count - $display,
            'display'=>$display,
            'likes'=>$likes,
            'is_like' => $is_like,

        ]);
    }
    public function findModel($id){
        return Post::findOne($id);
    }
    public function actionLike(){
        if (\Yii::$app->request->isAjax){
            $get = \Yii::$app->request->get();
            $blogId = $get['blogId'];
            $userId = \Yii::$app->user->id;
            $like = LikeTable::findOne(['postId'=>$blogId,'userId'=>$userId]);
            \Yii::$app->response->format = Response::FORMAT_JSON;
            if($like){
                $like->delete();
                return [
                    'remove'=>1
                ];
            }else{
                $like = new LikeTable();
                $like->postId = $blogId;
                $like->userId = $userId;
                $like->created_at = time();
                $like->save(false);
                return [
                    'remove'=>0,
                ];
            }
        }
    }
    
}
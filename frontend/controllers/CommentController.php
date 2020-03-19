<?php


namespace frontend\controllers;


use backend\models\CommentBlog;
use Pusher\Pusher;
use yii\web\Controller;
use yii\web\Response;

class CommentController extends Controller
{
    public function actionCreate(){
        if(\Yii::$app->request->isAjax){
            $get = \Yii::$app->request->get();
            $blogId = $get['blogId'];
            $userId = $get['userId'];
            $content = $get['content'];
            $parentId = $get['parentId'];
            $newComment = new CommentBlog();
            $newComment->userId = $userId;
            $newComment->parentId = $parentId;
            $newComment->content = $content;
            $newComment->blogId = $blogId;
            $newComment->created_at = time();
            if($newComment->save()){
                $options = array(
                    'cluster' => 'ap1',
                    'useTLS' => true
                );
                $pusher = new Pusher(
                    'd5057080fd4987bf00fe',
                    '2fb21d5883beda490578',
                    '965785',
                    $options
                );
                $view = $this->renderPartial('newComment',[
                    'newComment'=>$newComment,]);
                $data['parentId'] = $parentId;
                $data['view'] = $view;
                $data['userId'] = $userId;
                $pusher->trigger('my-channel', 'my-event', $data);
                \Yii::$app->response->format = Response::FORMAT_HTML;
                return $view;

            }
        }
    }
    public function actionMore(){
        if (\Yii::$app->request->isAjax){
            $get = \Yii::$app->request->get();
            $blogId = $get['blogId'];
            $count = $get['count'];
            $display = $get['display'];
            $offset = $count - $display;
            if($offset >= 0){
                $comments = CommentBlog::find()
                    ->where(['blogId'=>$blogId])
                    ->andWhere(['parentId'=>null])
                    ->limit(5)
                    ->offset($offset)
                    ->all();
                $display += 5;
                return $this->renderPartial('moreComment',[
                    'comments'=>$comments,
                    'count'=>$count,
                    'display'=>$display,
                ]);
            }else{
                $temp = $count%5;
                $comments = CommentBlog::find()
                    ->where(['blogId'=>$blogId])
                    ->andWhere(['parentId'=>null])
                    ->limit($temp)
                    ->offset(0)
                    ->all();
                $display += 5;
                return $this->renderPartial('moreComment',[
                    'comments'=>$comments,
                    'count'=>$count,
                    'display'=>$display,
                ]);
            }
        }
    }
}
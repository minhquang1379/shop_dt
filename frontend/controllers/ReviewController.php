<?php


namespace frontend\controllers;


use backend\models\ReviewsProduct;
use yii\web\Controller;

class ReviewController extends Controller
{
    public function actionSend(){
        if(\Yii::$app->request->isAjax){
            $get = \Yii::$app->request->get();
            $content = $get['content'];
            $productId = $get['productId'];
            $score = $get['score'];

            $review = new ReviewsProduct();
            $review->productId = $productId;
            $review->rating = $score;
            $review->content = $content;
            $review->userId = \Yii::$app->user->getId();
            if ($review->save(false)){
                return $this->renderPartial('newReview',[
                    'review'=>$review,
                ]);
            }
        }
    }
}
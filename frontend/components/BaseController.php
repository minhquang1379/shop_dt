<?php
namespace frontend\components;

use backend\models\Category;
use yii\web\Controller;

class BaseController extends  Controller
{
    public function init()
    {
        parent::init();
        \Yii::$app->params['category'] = new Category();
    }
}
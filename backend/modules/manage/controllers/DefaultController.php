<?php

namespace backend\modules\manage\controllers;

use backend\components\MyController;
use yii\web\Controller;

/**
 * Default controller for the `manage` module
 */
class DefaultController extends MyController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}

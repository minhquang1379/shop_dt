<?php

namespace backend\modules\authorization\controllers;

use backend\components\MyController;
use yii\web\Controller;

/**
 * Default controller for the `authorization` module
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

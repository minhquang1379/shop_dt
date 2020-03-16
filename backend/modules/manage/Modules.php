<?php

namespace backend\modules\manage;

/**
 * manage module definition class
 */
class Modules extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\modules\manage\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->layoutPath = \Yii::getAlias('@layouts');
        $this->layout = 'main1';

        // custom initialization code goes here
    }
}

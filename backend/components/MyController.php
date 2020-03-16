<?php


namespace backend\components;


use backend\modules\authorization\models\ManageController;
use yii\filters\AccessControl;
use yii\web\Controller;

class MyController extends Controller
{
    public function  behaviors()
    {
        return [
            'access'=>[
                'class' => AccessControl::className(),
                'rules'=>[
                  [
                      'allow'=>true,
                      'roles'=>['@'],
                      'matchCallback'=>function($rules, $action){
                            $util = new UtilClass();
                            $moduleId = \Yii::$app->controller->module->id;
                            if($moduleId != 'backend')
                            $moduleId = $util->getFullModulePath($moduleId);
                            return \Yii::$app->user->can($moduleId.'-'.\Yii::$app->controller->id.'-'.$action->id);
                      },
                  ],
                ],
                'denyCallback'=>function(){
                    \Yii::$app->session->setFlash('error','you dont have permission');
                    return $this->goHome();
                }
            ],
        ];
    }
}
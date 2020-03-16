<?php


namespace frontend\models;


use common\models\User;
use yii\base\Model;

class ChangePassword extends Model
{
    public $oldPassword;
    public $newPassword;
    public $rePassword;
    public function rules()
    {
        return [
            [['oldPassword','newPassword','rePassword'],'required'],
            [['oldPassword','newPassword','rePassword'],'string','min'=>6],
            [['rePassword'],'compare','compareAttribute'=>'newPassword'],
            [['oldPassword'], function($attribute, $params, $validator){
                $user = User::findOne(['id'=>\Yii::$app->user->getId()]);
                if(!\Yii::$app->getSecurity()->validatePassword($this->oldPassword,$user->password_hash)){
                    $this->addError($attribute,'Wrong password');
                }
            }]
        ];
    }
    public function attributeLabels()
    {
        return [
            'oldPassword'=>'Old Password',
            'newPassword'=>'New Password',
            'rePassword'=>'Re-Password',
        ];
    }
}
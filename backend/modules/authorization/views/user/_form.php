<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>

    <h4>Roles</h4>
    <?php foreach ($roles as $role):?>
        <div class="form-check checkbox-inline">
            <input class="form-check-input" type="checkbox" value="<?=$role->name?>" name="roles[]">
            <label class="form-check-label" >
                <?= $role->name?>
            </label>
        </div>
    <?php endforeach;?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

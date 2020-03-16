<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\authorization\models\ManageController */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manage-controller-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'controller_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'module_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

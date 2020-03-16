<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Brand */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brand-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model,'image')->fileInput(['class'=>'fileBtn'])?>
    <div class="form-group">
        <?php if (isset($model->image)):?>
            <?= Html::img('@web/upload/brand/'.$model->image,['class'=>'img-select'],['id'=>"img-select"]);?>
        <?php else:?>
            <?= Html::img('@web/img/select.png',['class'=>'img-select'],['id'=>"img-select"]);?>
        <?php endif;?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

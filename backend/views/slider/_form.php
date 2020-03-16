<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Slider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'caption')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput(['class'=>'fileBtn'])?>
    <div class="form-group">
        <?php if (isset($model->image)):?>
            <?= Html::img('@web/upload/slider/'.$model->image,['class'=>'img-select'],['id'=>"img-select"]);?>
        <?php else:?>
            <?= Html::img('@web/img/select.png',['class'=>'img-select'],['id'=>"img-select slider"]);?>
        <?php endif;?>
    </div>
    <?= $form->field($model,'is_active')->dropDownList($model->getActive())?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php
$form = ActiveForm::begin([
    'method'=>'post'
])?>
<?= $form->field($model,'name')->textInput()?>
<?= $form->field($model,'address')->textInput()?>
<?= $form->field($model,'phone')->textInput()?>
<?=Html::submitButton('Save',['class'=>'btn btn-success'])?>
<?php ActiveForm::end()?>
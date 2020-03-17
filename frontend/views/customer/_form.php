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
<?= $form->field($model, 'image')->fileInput(['class'=>'fileBtn'])?>;
    <div class="form-group">
        <?php if (isset($model->image)):?>
            <?= Html::img('@web/upload/avatar/'.$model->image,['class'=>'img-select'],['id'=>"img-select"]);?>
        <?php else:?>
            <?= Html::img('@web/img/select.png',['class'=>'img-select'],['id'=>"img-select"]);?>
        <?php endif;?>
    </div>
<?=Html::submitButton('Save',['class'=>'btn btn-success'])?>
<?php ActiveForm::end()?>
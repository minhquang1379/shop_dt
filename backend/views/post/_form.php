<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">
    <?php if(Yii::$app->session->getFlash('danger')):?>
        <div class="alert alert-danger"><?= Yii::$app->session->getFlash('danger')?></div>
    <?php endif;?>
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model,'shortDescription')->textarea(['rows'=>'2','style'=>['resize'=>'none']])?>

    <?= $form->field($model, 'thumbnail')->fileInput(['class'=>'fileBtn'])?>;
    <div class="form-group">
        <?php if (isset($model->thumbnail)):?>
            <?= Html::img('@web/upload/post/'.$model->thumbnail,['class'=>'img-select'],['id'=>"img-select"]);?>
        <?php else:?>
            <?= Html::img('@web/img/select.png',['class'=>'img-select'],['id'=>"img-select"]);?>
        <?php endif;?>
    </div>

    <?= $form->field($model, 'content')->textarea(['rows' => '12']) ?>
    <script>
        var editor =  CKEDITOR.replace( 'post-content',{
            filebrowserBrowseUrl: '../ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl: '../ckfinder/ckfinder.html?Type=Images',
            filebrowserUploadUrl: '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserWindowWidth : '1000',
            filebrowserWindowHeight : '700',
            extraPlugins: 'image2'
        } );
        CKFinder.setupCKEditor( editor );
    </script>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

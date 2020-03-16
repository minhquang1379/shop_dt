<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput(['class'=>'fileBtn']) ?>
    <div class="form-group">
        <?php if (isset($model->image)):?>
            <?= Html::img('@web/upload/product/'.$model->image,['class'=>'img-select'],['id'=>"img-select"]);?>
        <?php else:?>
            <?= Html::img('@web/img/select.png',['class'=>'img-select'],['id'=>"img-select"]);?>
        <?php endif;?>
    </div>
    <?= $form->field($model, 'inStock')->textInput(['type'=>'number','min'=>0]) ?>



    <?php if(isset($model->unitId)){
        echo $form->field($model, 'unitId')->dropDownList($model->getUnitDropdownList(),
            ['options'=>['unitId'=>['selected'=>'true']]]
        );
    }else{
        echo $form->field($model, 'unitId')->dropDownList($model->getUnitDropdownList());
    }?>
    <?php if(isset($model->brandId)){
        echo $form->field($model, 'brandId')->dropDownList($model->getBrandDropdownList(),
            ['options'=>['brandId'=>['selected'=>'true']]]
        );
    }else{
        echo $form->field($model, 'brandId')->dropDownList($model->getBrandDropdownList());
    }?>
    <?php if(isset($model->supplierId)){
        echo $form->field($model, 'supplierId')->dropDownList($model->getSupplierDropdownList(),
            ['options'=>['supplierId'=>['selected'=>'true']]]
        );
    }else{
        echo $form->field($model, 'supplierId')->dropDownList($model->getSupplierDropdownList());
    }?>
    <?php if(isset($model->categoryId)){
        echo $form->field($model, 'categoryId')->dropDownList($model->getCategoryDropdownList(),
            ['options'=>['categoryId'=>['selected'=>'true']]]
        );
    }else{
        echo $form->field($model, 'categoryId')->dropDownList($model->getCategoryDropdownList());
    }?>
    <?=$form->field($model,'description')->textarea(['style'=>['resize'=>'none']])?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

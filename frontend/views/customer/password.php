<?php
use yii\widgets\ActiveForm;

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Profile </h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-content-right">
                    <h3 id="order_review_heading">Create Profile</h3>
                    <?php $form = ActiveForm::begin()?>
                    <?=$form->field($model,'oldPassword')->passwordInput()?>
                    <?=$form->field($model,'newPassword')->passwordInput()?>
                    <?=$form->field($model,'rePassword')->passwordInput()?>
                    <?=\yii\helpers\Html::submitButton('Save',['class'=>'btn btn-primary'])?>
                    <?php ActiveForm::end()?>
                </div>
            </div>
        </div>
    </div>
</div>



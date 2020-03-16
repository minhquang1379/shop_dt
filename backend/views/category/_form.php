<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \backend\models\Category;
/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?php if(isset($model->parent0->id )):?>
        <?= $form->field($model, 'parent')->dropDownList(
            $model->getDropdownlist(),
            [
                'options'=>[
                    $model->parent0->id =>['selected'=>true]
                ]
            ]
        )
        ?>
    <?php else:?>
        <?= $form->field($model, 'parent')->dropDownList(
            $model->getDropdownlist()
        )
        ?>
    <?php endif;?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

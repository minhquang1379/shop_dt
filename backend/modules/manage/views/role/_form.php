<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <div class="h4" >Manage Controller</div>
    <div class="form-check checkbox-inline">
        <input class="form-check-input itemCheck" type="checkbox" value="All" name=""/>
        <label class="form-check-label">
            All
        </label>
    </div>
    <?php foreach ($itemAction as $action):?>
    <div class="form-check checkbox-inline">
        <input class="form-check-input itemCheck" type="checkbox" value="<?= $action?>" name="Item[]"
        <?php
             if(isset($childRole['backend\modules\manage-'.'Item-'.$action])){
                 echo 'checked="checked"';
             }
        ?>
        />
        <label class="form-check-label">
            <?= $action?>
        </label>
    </div>
    <?php endforeach;?>
    <div class="h4" >Manage Role</div>
    <div class="form-check checkbox-inline">
        <input class="form-check-input roleCheck" type="checkbox" value="All" name=""/>
        <label class="form-check-label">
            All
        </label>
    </div>
    <?php foreach ($roleAction as $action):?>
        <div class="form-check checkbox-inline">
            <input class="form-check-input roleCheck" type="checkbox" value="<?= $action?>" name="Role[]"
                <?php
                if(isset($childRole['backend\modules\manage-'.'Role-'.$action])){
                    echo 'checked="checked"';
                }
                ?>>
            <label class="form-check-label">
                <?= $action?>
            </label>
        </div>
    <?php endforeach;?>

    <div class="h4" >Authorization Controller</div>
    <div class="form-check checkbox-inline">
        <input class="form-check-input assignmentCheck" type="checkbox" value="All" name=""/>
        <label class="form-check-label">
            All
        </label>
    </div>
    <?php foreach ($assignAction as $action):?>
        <div class="form-check checkbox-inline">
            <input class="form-check-input assignmentCheck" type="checkbox" value="<?= $action?>" name="Assignment[]"
                <?php
                if(isset($childRole['backend\modules\authorization-'.'Assignment-'.$action])){
                    echo 'checked="checked"';
                }
                ?>>
            <label class="form-check-label">
                <?= $action?>
            </label>
        </div>
    <?php endforeach;?>
    <div class="h4" >Authorization Role</div>
    <div class="form-check checkbox-inline">
        <input class="form-check-input rolesCheck" type="checkbox" value="All" name=""/>
        <label class="form-check-label">
            All
        </label>
    </div>
    <?php foreach ($authorRoles as $action):?>
        <div class="form-check checkbox-inline">
            <input class="form-check-input rolesCheck" type="checkbox" value="<?= $action?>" name="Roles[]"
                <?php
                if(isset($childRole['backend\modules\authorization-'.'Roles-'.$action])){
                    echo 'checked="checked"';
                }
                ?>>
            <label class="form-check-label">
                <?= $action?>
            </label>
        </div>
    <?php endforeach;?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

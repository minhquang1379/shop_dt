<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Role', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="auth-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->name], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'type',
            'description:ntext',
            'rule_name',
            'data',
            [
                    'attribute'=>'created_at',
                    'value'=> function($model){
                        if($model->created_at) return date('Y-m-d H:i:s', $model->created_at);
                    }
            ],
           [
                   'attribute'=>'updated_at',
                    'value'=>function($model){
                        if($model->updated_at) return date('Y-m-d H:i:s', $model->updated_at);
                    }
           ],
        ],
    ]) ?>
    <div class="h4" >Manage Controller</div>
    <?php foreach ($itemAction as $action):?>
        <div class="form-check checkbox-inline">
            <input class="form-check-input" type="checkbox" value="<?= $action?>" name="Item[]" disabled
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
    <?php foreach ($roleAction as $action):?>
        <div class="form-check checkbox-inline">
            <input class="form-check-input" type="checkbox" value="<?= $action?>" name="Role[]" disabled
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
    <?php foreach ($assignAction as $action):?>
        <div class="form-check checkbox-inline">
            <input class="form-check-input assignmentCheck" type="checkbox" value="<?= $action?>" name="Assignment[]" disabled
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
    <div class="h4" >Authorization Controller</div>
    <?php foreach ($authorRoles as $action):?>
        <div class="form-check checkbox-inline">
            <input class="form-check-input RolesCheck" type="checkbox" value="<?= $action?>" name="Roles[]" disabled
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
</div>

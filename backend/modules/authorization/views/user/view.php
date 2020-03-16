<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'username',
            'email:email',
            [
                    'attribute'=>'status',
                    'value'=>function($model){
                        return $model->getstatus();
                    }
            ],
        ],
    ]) ?>
    <?php foreach($roles as $role):?>
        <div class="form-check checkbox-inline">
            <input class="form-check-input" type="checkbox" value="<?=$role->name?>" name="roles[]" disabled
                <?php
                    if( array_search($role,$myRoles)){
                        echo 'checked="checked"';
                    }
                ?>
            >
            <label class="form-check-label" >
                <?= $role->name?>
            </label>
        </div>
    <?php endforeach;?>
</div>

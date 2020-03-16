<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItem */

$this->title = 'Update Auth Item: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Role', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="auth-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'itemAction'=>$itemAction,
        'roleAction'=>$roleAction,
        'assignAction'=>$assignAction,
        'authorRoles'=>$authorRoles,
        'childRole'=>$chileRole,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\authorization\models\ManageController */

$this->title = 'Update Manage Controller: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Manage Controllers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="manage-controller-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

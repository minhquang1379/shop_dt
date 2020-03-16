<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\authorization\models\ManageController */

$this->title = 'Create Manage Controller';
$this->params['breadcrumbs'][] = ['label' => 'Manage Controllers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manage-controller-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

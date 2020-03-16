<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\authorization\models\ManageControllerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Controllers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manage-controller-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Manage Controller', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'controller_id',
            'module_name',
            'alias_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

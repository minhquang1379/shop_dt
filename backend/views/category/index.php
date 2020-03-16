<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                    'label'=>'Parent',
                    'attribute'=>'parent',
                    'value'=>'parent0.name',
            ],
            [
                'label'=>'Create By',
                'value'=>'createdBy.username',
                'attribute'=>'created_by',
            ],
            [
                'label'=>'Create At',
                'value'=>function($model){
                    return date('y-m-d H:m:s', $model->created_at);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<!--    --><?php
//        $model = new \backend\models\Category();
//        $model->getAllCategory();
//    ?>

</div>

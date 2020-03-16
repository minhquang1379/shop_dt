<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Units';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Unit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
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
            //'updated_by',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

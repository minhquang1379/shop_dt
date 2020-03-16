<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SliderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sliders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Slider', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'caption',
            [
                'label'=>'image',
                'format'=>'html',
                'value'=>function($model){
                    return Html::img(\yii\helpers\Url::to(['upload/slider/'.$model->image]),['width'=>'200px']);
                }
            ],
            [
                'label'=>'status',
                'format'=>'html',
                'attribute'=>'is_active',
                'value'=>function($model){
                    return '<span class="label label-'.$model->getStatus()['class'].'">'.$model->getStatus()['name'].'</span>';
                },
                'headerOptions'=>['width'=>'10%']
            ],
            [
                'label'=>'Create By',
                'attribute'=>'created_by',
                'value'=>function($model){
                    return $model->createdBy->username;
                }
            ],
            //'created_at',
            //'updated_by',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

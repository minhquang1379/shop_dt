<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BrandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Brands';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Brand', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                    'label'=>'image',
                    'format'=>'html',
                    'attribute'=>'image',
                    'value'=>function($model){
                        return Html::img(['upload/brand/'.$model->image],['width'=>'150px']);
                    }
            ],
            [
                    'label'=>'Create By',
                    'attribute'=>'created_by',
                    'value'=>'createdBy.username'
            ],
            [
                    'label'=>'Created At',
                    'attribute'=>'created_at',
                    'value'=>function($model){
                        return date('y-m-d H:m:s', $model->created_at);
                    }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

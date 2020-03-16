<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\authorization\models\AuthItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Auth Role', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="auth-item-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'description:ntext',
            [
                    'attribute'=>'created_at',
                    'value'=>function($model){
                        if($model->created_at) return date('Y-m-y H:i:s',$model->created_at);
                    }
            ],
            [
                'attribute'=>'updated_at',
                'value'=>function($model){
                    if($model->updated_at) return date('Y-m-y H:i:s',$model->updated_at);
                }
            ],
        ],
    ]) ?>
    <h3>Controllers</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                    'label'=>'Name',
               'value'=>'alias_name',
                'attribute'=>'alias_name',

            ],
            'module_name',
            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view}',
                'buttons' => [
                    'view' => function ($url, $item) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                            \yii\helpers\Url::to(['assignment/view?id='.$item->id.'&role='.Yii::$app->getRequest()->getQueryParams('id')['id']]), [
                            'title' => Yii::t('app', 'lead-view'),
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>

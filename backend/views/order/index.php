<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'user',
                'attribute'=>'userId',
                'value'=>function($model){
                    return $model->user->username;
                }

            ],
            [
                    'label'=>'Total',
                    'attribute'=>'total',
                    'value'=>function($model){
                        return  '$'.number_format($model->total,0,',','.');
                    }
            ],
            'address',
            'phone',
            //'status',
            //'receive_name',
            //'create_at',
            [
                    'label'=>'status',
                    'attribute'=>'status',
                    'format'=>'raw',
                    'filter'=>function($model){
                        $array =  $model->getcStatus();
                    },
                    'headerOptions'=>['width'=>'15%'],
                    'value'=>function($model){
                        return Html::dropDownList('dropDown',$model->status,$model->getStatus(),[
                                'onchange'=> "changeStatus($(this).val(), '$model->id')",
                        ]);
                    }
            ],
            [
                'label'=>'Remove',
                'attribute'=>'is_delete',
                'format'=>'raw',
                'headerOptions'=>['width'=>'15%'],
                'value'=>function($model){
                    return Html::dropDownList('dropDown',$model->is_delete,$model->getRemove()
                    );
                }
            ],
            [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'action',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>[
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',['order/view?orderId='.$model->id] , [
                                'title' => Yii::t('app', 'lead-view'),
                            ]);
                        },

                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'lead-update'),
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title' => Yii::t('app', 'lead-delete'),
                                'data-method'=>['Post'],
                            ]);
                        }
                    ]
            ],
        ],
    ]); ?>
</div>

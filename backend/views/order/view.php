<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
            'receive_name',
            [
                    'label'=>'status',
                    'attribute'=>'status',
                    'format'=>'raw',
                    'value'=>function($model){
                        return Html::dropDownList('dropDown',$model->status,$model->getStatus(),[
                            'onchange'=> "changeStatus($(this).val(), '$model->id')",
                        ]);
                    }
            ],
            [
                    'label'=>'Create At',
                    'attribute'=>'create_at',
                    'value'=>function($model){
                        return date('y-m-d H:i:s',$model->create_at);
                    }
            ],
        ],
    ]) ?>
    <h2>Order Detail</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                    'label'=>'Product Name',
                    'attribute'=>'productId',
                    'headerOptions'=>['width'=>'20%'],
                    'value'=>function($model){
                        return $model->product->name;
                    }
            ],
            [
                'label'=>'Image',
                'format'=>'html',
                'headerOptions'=>['width'=>'15%'],
                'value'=>function($model){
                    return Html::img(['upload/product/'.$model->product->image]);
                }
            ],
            [
                'label'=>'Price',
                'value'=>function($model){
                    return '$ '.number_format($model->price,0,',','.');
                }
            ],
            [
                'label'=>'Quantity',
                'attribute'=>'quantity',
                'headerOptions'=>['width'=>'3%'],
                'value'=>function($model){

                    return $model->quantity;
                }
            ],
            [
                'label'=>'Total',
                'value'=>function($model){
                    $price = (int)$model->price;
                    return '$ '.number_format($price * $model->quantity,0,',','.');
                }
            ],
            [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'action',
                    'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',['product/view?id='.$model->product->id] , [
                            'title' => Yii::t('app', 'lead-view'),
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>
</div>

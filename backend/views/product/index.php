<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                    'label'=>'price',
                    'attribute'=>'price',
                    'value'=>function($model){
                        return number_format($model->price,0,',','.').' $';
                    },
            ],
            [
                    'label'=>'image',
                    'format'=>'html',
                    'attribute'=>'image',
                    'value'=>function($model){
                        return Html::img(['upload/product/'.$model->image],['width'=>'140px']);
                    }
            ],
            [
                    'label'=>'Stock',
                    'attribute'=>'inStock',
                    'headerOptions'=>['width'=>'5%'],
                    'value'=>'inStock',
            ],
            [
                'label'=>'Order',
                'attribute'=>'inOrder',
                'headerOptions'=>['width'=>'5%'],
                'value'=>'inOrder',
            ],
            [
                'label'=>'Cart',
                'attribute'=>'inCart',
                'headerOptions'=>['width'=>'5%'],
                'value'=>'inCart',
            ],
            [
                    'label'=>'unit',
                    'attribute'=>'unitId',
                    'value'=>'unit.name',
            ],
            [
                'label'=>'brand',
                'attribute'=>'brandId',
                'value'=>'brand.name',
            ],
            [
                'label'=>'supplier',
                'attribute'=>'supplierId',
                'value'=>'supplier.name',
            ],
            [
                'label'=>'Category',
                'attribute'=>'categoryId',
                'value'=>'category.name',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

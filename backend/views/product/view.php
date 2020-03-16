<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

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
            'name',
            'price',
            [
                    'label'=>'image',
                    'format'=>'html',
                    'attribute'=>'image',
                    'value'=>function($model){
                        return Html::img(['upload/product/'.$model->image],['width'=>'200px']);
                    }
            ],
            'inStock',
            'inOrder',
            'inCart',
            [
                    'label'=>'Unit',
                    'attribute'=>'unitId',
                    'value'=>function($model){
                        if(isset($model->unit->name))
                            return $model->unit->name;
                        return null;
                    }
            ],
            [
                    'label'=>'Brand',
                    'attribute'=>'brandId',
                    'value'=>function($model){
                        if(isset($model->brand->name))
                            return $model->brand->name;
                        return null;
                    }
            ],
            [
                    'label'=>'Supplier',
                    'attribute'=>'supplierId',
                    'value'=>function($model){
                        if(isset($model->supplier->name))
                            return $model->supplier->name;
                        return null;
                    }
            ],
            [
                'label'=>'Category',
                'attribute'=>'categoryId',
                'value'=>function($model){
                    if($model->category->name){
                        return $model->category->name;
                    }
                    return null;
                }
            ],
            [
                'label'=>'Create By',
                'attribute'=>'created_by',
                'value'=>function($model){
                    return $model->createdBy->username;
                }
            ],
            [
                'label'=>'Create At',
                'attribute'=>'created_at',
                'value'=>function($model){
                    return date('y-m-d H:i:s',$model->created_at);
                }

            ],
            [
                'label'=>'Update By',
                'attribute'=>'updated_by',
                'value'=>function($model){
                    if(isset($model->updatedBy->username))
                        return $model->updatedBy->username;
                    return null;
                }
            ],
            [
                'label'=>'Update At',
                'attribute'=>'updated_at',
                'value'=>function($model){
                    if(isset($model->updated_at))
                        return date('y-m-d H:i:s',$model->updated_at);
                    return null;
                }
            ],
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view">

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
            'title',
            [
                'label'=>'Thumbnail',
                'format'=>'html',
                'value'=>function($model){
                    return Html::img(\yii\helpers\Url::to(['upload/post/'.$model->thumbnail]),['width'=>'150px']);
                }
            ],
            [
                'label'=>'description',
                'attribute'=>'shortDescription',
                'value'=>'shortDescription',
            ],
            'content:html',
            'like',
            'views',
            [
                'label'=>'Author',
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

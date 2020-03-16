<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\DetailView;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\modules\authorization\models\ManageController */

$role = Yii::$app->getRequest()->getQueryParams('role')['role'];
$this->title = $role.': '. $model->alias_name;
$this->params['breadcrumbs'][] = ['label' => $role, 'url' => Url::to(['roles/view?id='.$role])];

$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="manage-controller-view">
    <?=
    Breadcrumbs::widget([
        'homeLink' => [
            'label' => Yii::t('yii', 'Dashboard'),
            'url' => Yii::$app->homeUrl,
        ],
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ])
    ?>

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'controller_id',
            'module_name',
            'alias_name',
        ],
    ]) ?>
    <h4>Actions</h4>
<?php $form = \yii\widgets\ActiveForm::begin([
        'action'=>['assignment/update', 'id'=>$model->id, 'role'=>$role],
    'method'=>'post'
]);?>
        <div class="form-check checkbox-inline">
            <input class="form-check-input actionCheck" type="checkbox" value="All" >
            <label class="form-check-label" >
                All
            </label>
        </div>
        <?php foreach($actions as $action):?>
            <div class="form-check checkbox-inline">
                <input class="form-check-input actionCheck" type="checkbox" value="<?=$action?>" name="action[]"
                    <?php
                    $controllerId = str_replace('Controller','',$model->controller_id);
                        if(isset($childRole[$model->module_name.'-'.$controllerId.'-'.$action])){
                            echo 'checked="checked"';
                        }
                    ?>
                >
                <label class="form-check-label" >
                    <?=$action?>
                </label>
            </div>
        <?php endforeach;?>
    <div class="form-group" >
        <?=Html::submitButton('Update',['class'=>'btn btn-primary'])?>
    </div>
<?php \yii\widgets\ActiveForm::end()?>
</div>
<p>
</p>

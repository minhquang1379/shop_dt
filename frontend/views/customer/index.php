<?php

use yii\helpers\Html;

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Profile </h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-content-right">
                    <?php
                    if($model){
                        echo \yii\widgets\DetailView::widget([
                            'model'=>$model,
                            'attributes'=>[
                                'name',
                                'phone',
                                'address',
                                [
                                        'label'=>'Username',
                                        'value'=>function($model){
                                            return $model->user->username;
                                        }
                                ],
                                [
                                        'label'=>'Avatar',
                                        'format'=>'html',
                                        'value'=>function($model){
                                            return Html::img(\yii\helpers\Url::to(['upload/avatar/'.$model->image]),['width'=>'150px']);
                                        }
                                ],
                            ],
                        ]);
                        echo '<a  href="'.\yii\helpers\Url::to(['customer/update']).'" class="btn btn-success profileBtn" > Update</a>';
                        echo '<a  href="'.\yii\helpers\Url::to(['customer/password']).'" class="btn btn-warning profileBtn" > Change password</a>';
                    }else{
                        echo '<div class="alert alert-success text-center text-uppercase" >please create your profile</div>';
                        echo '<a  href="'.\yii\helpers\Url::to(['customer/create']).'" class="btn btn-primary center-block editBtn" > Create</a>';
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>
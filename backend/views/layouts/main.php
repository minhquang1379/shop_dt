<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode('Admin') ?></title>
        <?php $this->head() ?>
        <script src="../ckeditor/ckeditor.js" ></script>
        <script src="../ckfinder/ckfinder.js" ></script>
    </head>
    <body>
    <?php $this->beginBody() ?>


    <div class="wrapper">
        <?php
        $links = [];
        if(!Yii::$app->user->isGuest){
            if(Yii::$app->user->can('backend-Student-Index')){
                $links[]= ['title'=>'Student','url'=>['student/index'],'icon'=>'user'];
            }
            if(Yii::$app->user->can('backend-Post-Index')){
                $links[]= ['title'=>'Post','url'=>['post/index'],'icon'=>'book'];
            }
            if(Yii::$app->user->can('backend-Unit-Index')){
                $links[]= ['title'=>'Unit','url'=>['unit/index'],'icon'=>'unit'];
            }
            if(Yii::$app->user->can('backend-Category-Index')){
                $links[]= ['title'=>'Category','url'=>['category/index']];
            }
            if(Yii::$app->user->can('backend-Brand-Index')){
                $links[]= ['title'=>'Brand','url'=>['brand/index']];
            }
            if(Yii::$app->user->can('backend-Supplier-Index')){
                $links[]= ['title'=>'Supplier','url'=>['supplier/index']];
            }
            if(Yii::$app->user->can('backend-Product-Index')){
                $links[]= ['title'=>'Product','url'=>['product/index']];
            }
            if(Yii::$app->user->can('backend-Slider-Index')){
                $links[]= ['title'=>'Slider','url'=>['slider/index']];
            }
            if(Yii::$app->user->can('backend-Order-Index')){
                $links[]= ['title'=>'Order','url'=>['order/index']];
            }
        }
        ?>
        <?= \hosannahighertech\lbootstrap\widgets\SideBar::widget([
            'header'=>[
                'title'=>'Menu',
                'url'=>['/site/index']
            ],
            'links'=>$links,
        ]) ?>
        <?php
        $linksBar = [];
        $linksBar[]=['label' => 'Home', 'url' => ['/site/index']];
        if(!Yii::$app->user->isGuest){

            if(Yii::$app->user->can('backend\modules\authorization-Roles-Index')){
                $linksBar[]=['label' => 'Manage', 'url' => ['/authorization/roles']];
            }
            $linksBar[]=['label'=>'logout ('.Yii::$app->user->identity->username.' )','url'=>['site/logout'],'linkOptions' => ['data-method' => 'post']];
        }

        ?>
        <div class="main-panel">
            <?= \hosannahighertech\lbootstrap\widgets\NavBar::widget([
                'theme'=>'red',
                'brand'=>[
                    'label'=>'Home Page'
                ],
                'links'=>$linksBar,
            ]) ?>
            <div class="content">
                <div class="container-fluid">
                    <?= $content ?>
                </div>
            </div>

            <footer class="footer">
<!--                <div class="container-fluid">-->
<!--                    <nav class="pull-left">-->
<!--                        <ul>-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    Home-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    Company-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    Portfolio-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    Blog-->
<!--                                </a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </nav>-->
<!--                    <p class="copyright pull-right">-->
<!--                        &copy; --><?//= date('Y') ?><!-- <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web-->
<!--                    </p>-->
<!--                </div>-->
            </footer>

        </div>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>
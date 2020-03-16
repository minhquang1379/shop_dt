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
    </head>
    <body>
    <?php $this->beginBody() ?>


    <div class="wrapper">
        <?php
        $menuItems = [];
        if(!Yii::$app->user->isGuest){
            if(Yii::$app->user->can('backend\modules\authorization-User-Index')){
                $menuItems[] = ['title' => 'User', 'url' => ['/authorization/user']];
            }if(Yii::$app->user->can('backend\modules\authorization-Roles-Index')){
                $menuItems[] = ['title' => 'Authorization Roles', 'url' => ['/authorization/roles']];
            }if(Yii::$app->user->can('backend\modules\manage-Item-Index')){
                $menuItems[] = ['title' => 'Controller', 'url' => ['/manage/item']];
            }if(Yii::$app->user->can('backend\modules\manage-Role-Index')){
                $menuItems[] = ['title' => 'Mange Roles', 'url' => ['/manage/role']];
            }
        }
        ?>
        <?= \hosannahighertech\lbootstrap\widgets\SideBar::widget([

            'header'=>[
                'title'=>'Menu',
                'url'=>['/site/index']
            ],
            'links'=>$menuItems,
        ]) ?>
        <?php
        $linksBar = [];
        $linksBar[]=['label' => 'Home', 'url' => ['/site/index']];
        if(!Yii::$app->user->isGuest){

            if(Yii::$app->user->can('backend\modules\authorization-Roles-Index')){
                $linksBar[]=['label' => 'Manage', 'url' => ['/authorization/roles']];
            }
            $linksBar[]=['label'=>'logout ('.Yii::$app->user->identity->username.' )','url'=>['/site/logout'], 'linkOptions' => ['data-method' => 'post']];
        }
        ?>
        <div class="main-panel">
            <?= \hosannahighertech\lbootstrap\widgets\NavBar::widget([
                'theme'=>'red',
                'brand'=>[
                    'label'=>'Manage Page'
                ],
                'links'=>$linksBar,
            ]) ?>

            <div class="content">
                <div class="container-fluid">
                    <?= $content ?>
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <p class="copyright pull-right">
                        &copy; <?= date('Y') ?> <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                    </p>
                </div>
            </footer>

        </div>
    </div>

    <?php $this->endBody() ?>
    <script>


        $(document).ready(function () {
            function checkBoxClickAll(className){
                $('.'+className).on('change',function () {
                    if( $(this).val() == 'All'  ){
                        if(this.checked){
                            $('.'+className).prop('checked', true);
                        }else{
                            $('.'+className).prop('checked', false);
                        }
                    }
                });
            }
            $('#managecontroller-controller_id').on('click',function () {
                str =  $(this).val();
                array = str.split('.');
                $('#managecontroller-module_name').val(array[0]);
                $('#managecontroller-alias_name').val(array[1]);
            });
            checkBoxClickAll('itemCheck');
            checkBoxClickAll('roleCheck');
            checkBoxClickAll('actionCheck');
            checkBoxClickAll('assignmentCheck');
            checkBoxClickAll('rolesCheck');
        });
    </script>



    </body>
    </html>
<?php $this->endPage() ?>
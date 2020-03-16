<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use \yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    <script src="https://kit.fontawesome.com/5845faa3cb.js" crossorigin="anonymous"></script>

</head>
<body>
<?php $this->beginBody() ?>
<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="user-menu">
                    <ul>
                        <li><a href="<?= Url::to(['cart/index'])?>"><i class="fas fa-shopping-cart"></i> My Cart</a></li>
                        <?php if (Yii::$app->user->isGuest):?>
                        <li><a href="<?=Url::to(['site/login'])?>"><i class="fa fa-user"></i> Login</a></li>
                        <li><a href="<?=Url::to(['site/signup'])?>"><i class="fas fa-pencil-alt"></i> Signup</a></li>
                        <?php else:?>
                        <li><a href="<?=Url::to(['customer/index'])?>"><i class="fas fa-male"></i> My Account</a></li>
                         <li><a href="<?= Url::to(['order/index'])?>"><i class="fas fa-money-check-alt"></i> Order</a></li>
                        <li><a href="<?=Url::to(['site/logout'])?>" data-method="post" ><i class="fas fa-pencil-alt"></i> Logout</a></li>
                        <li>Welcome <?=Yii::$app->user->identity->email?></li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="header-right">
                    <ul class="list-unstyled list-inline">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End header area -->

<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="logo">
                    <h1><a href="<?=Url::to(['site/index'])?>"><img src="<?=Url::to(['img/logo.png'])?>"></a></h1>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="shopping-item">
                    <a href="<?= Url::to(['cart/index'])?>">Cart<i class="fa fa-shopping-cart"></i>
                        <?php
                            $cart = Yii::$app->cart;
                            if(!empty($cart->getTotalCount())){
                                echo ' <span class="product-count">'.$cart->getTotalCount().'</span>';
                            }
                        ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End site branding area -->


<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li <?= Yii::$app->controller->id == 'site'? 'class="active"': ''  ?> ><a href="<?= Url::to(['/site'])?>">Home</a></li>
                    <li <?= Yii::$app->controller->id == 'blog'? 'class="active"': ''  ?> ><a href="<?= Url::to(['blog/index'])?>">Blog</a></li>
                    <li <?= Yii::$app->controller->id == 'category'? 'class="active"': ''  ?> ><a href="<?=Url::to(['category/index'])?>">Shop</a></li>
                    <li <?= Yii::$app->controller->action->id == 'contact'? 'class="active"': ''  ?> > <a href="<?=Url::to(['site/contact'])?>">Contact</a></li>
                    <li <?= Yii::$app->controller->action->id == 'about'? 'class="active"': ''  ?> > <a href="<?=Url::to(['site/about'])?>">About</a></li>
                </ul>
            </div>
        </div>
    </div>
</div> <!-- End mainmenu area -->
<?php
if(!empty(Yii::$app->session->getAllFlashes())){
    foreach(Yii::$app->session->getAllFlashes() as $key => $message) {
        echo '<div class="alert alert-'.$key.' text-center">' . $message ."</div>\n";
    }
}
?>
<?= $content?>


<div class="footer-top-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="footer-about-us">
                    <h2>u<span>Stora</span></h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis sunt id doloribus vero quam laborum quas alias dolores blanditiis iusto consequatur, modi aliquid eveniet eligendi iure eaque ipsam iste, pariatur omnis sint! Suscipit, debitis, quisquam. Laborum commodi veritatis magni at?</p>
                    <div class="footer-social">
                        <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="footer-menu">
                    <h2 class="footer-wid-title">User Navigation </h2>
                    <ul>
                        <li><a href="#">My account</a></li>
                        <li><a href="#">Order history</a></li>
                        <li><a href="#">Wishlist</a></li>
                        <li><a href="#">Vendor contact</a></li>
                        <li><a href="#">Front page</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="footer-menu">
                    <h2 class="footer-wid-title">Categories</h2>
                    <ul>
                        <li><a href="#">Mobile Phone</a></li>
                        <li><a href="#">Home accesseries</a></li>
                        <li><a href="#">LED TV</a></li>
                        <li><a href="#">Computer</a></li>
                        <li><a href="#">Gadets</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="footer-newsletter">
                    <h2 class="footer-wid-title">Newsletter</h2>
                    <p>Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your inbox!</p>
                    <div class="newsletter-form">
                        <form action="#">
                            <input type="email" placeholder="Type your email">
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End footer top area -->

<div class="footer-bottom-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="copyright">
                    <p>&copy; 2015 uCommerce. All Rights Reserved. <a href="http://www.freshdesignweb.com" target="_blank">freshDesignweb.com</a></p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="footer-card-icon">
                    <i class="fa fa-cc-discover"></i>
                    <i class="fa fa-cc-mastercard"></i>
                    <i class="fa fa-cc-paypal"></i>
                    <i class="fa fa-cc-visa"></i>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End footer bottom area -->

<!-- Latest jQuery form server -->
<script src="https://code.jquery.com/jquery.min.js"></script>

<!-- Bootstrap JS form CDN -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<?php $this->endBody();?>
</body>
</html>
<?php $this->endPage() ?>

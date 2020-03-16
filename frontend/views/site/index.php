<?php
use yii\helpers\Url;

$this->title = 'Home';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-area">
    <!-- Slider -->
    <div class="block-slider block-slider4">
        <ul class="" id="bxslider-home4">
            <?php if(isset($sliders)):?>
            <?php foreach($sliders as $slider):?>
            <li>
                <img src="<?= Url::to(Yii::$app->urlManagerBackend->baseUrl.'/slider/'.$slider->image,true)?>" alt="Slide">
                <div class="caption-group">
                    <h2 class="caption title">
                        <?= $slider->title?>
                    </h2>
                    <h4 class="caption subtitle"><span class="primary"><?=$slider->caption?></span></h4>
                    <a class="caption button-radius" href="<?= Url::to(['category/index'])?>"><span class="icon"></span>Shop now</a>
                </div>
            </li>
            <?php endforeach;?>
            <?php endif;?>
        </ul>
    </div>
    <!-- ./Slider -->
</div> <!-- End slider area -->

<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title">Latest Products</h2>
                    <div class="product-carousel">
                        <?php if (isset($products)):?>
                        <?php foreach($products as $product):?>
                        <div class="single-product">
                            <div class="product-f-image">
                                <img src="<?= Url::to(Yii::$app->urlManagerBackend->baseUrl.'/product/'.$product->image, true)?>" alt="">
                                <div class="product-hover">
                                    <a href="<?= Url::to(['cart/add','id'=>$product->id])?>" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                    <a href="<?= Url::to(['product/index','id'=>$product->id])?>" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                </div>
                            </div>

                            <h2><a href="<?= Url::to(['product/index','id'=>$product->id])?>"><?=$product->name?></a></h2>

                            <div class="product-carousel-price">
                                <ins>$<?=number_format($product->price,0,',','.')?></ins> <del></del>
                            </div>
                        </div>
                        <?php endforeach;?>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End main content area -->
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <h2 class="section-title">Latest Blog</h2>
        <div class="row blog-contain">
            <?php if(isset($blogs)):?>
                <?php foreach ($blogs as $blog):?>
                    <div class="col-md-4 col-sm-6">
                        <div class="single-shop-product blog-item">
                            <div class="product-upper">
                                <img src="<?= Url::to(Yii::$app->urlManagerBackend->baseUrl.'/post/'.$blog->thumbnail, true)?>" alt="">
                            </div>
                            <h2><a href="<?= Url::to(['blog/view', 'id'=>$blog->id])?>"><?= $blog->title?></a></h2>
                            <div class="product-carousel-price">
                                <?= $blog->shortDescription?>
                            </div>

                            <div class="product-option-shop">
                                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="<?= Url::to(['blog/view', 'id'=>$blog->id])?>">Read more</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php endif;?>

        </div>
    </div>
</div>
<div class="brands-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="brand-wrapper">
                    <div class="brand-list">
                        <?php if (isset($brands)):?>
                        <?php foreach($brands as $brand):?>
                        <img src="<?= Url::to(Yii::$app->urlManagerBackend->baseUrl.'/brand/'.$brand->image,true)?>" alt="">
                        <?php endforeach;?>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End brands area -->

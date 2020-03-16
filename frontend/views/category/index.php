<?php

use yii\helpers\Url;

$this->title = 'Category';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shopping With Category</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-sidebar">
                    <h2 class="sidebar-title text-center">Category</h2>
                    <?php if(isset($categories)){
                        $categories->getMenuCategory();
                    }?>
                </div>

            </div>

            <div class="col-md-8">
                <div class="product-content-right">
                    <?php if (isset($category)):?>
                        <h2 class="sidebar-title text-center"><?=$category->name?></h2>
                    <?php endif?>

                    <div class="row">
                     <?php if(isset($products) && !empty($products)):?>
                     <?php foreach($products as $product):?>
                        <div class="col-md-4 col-sm-6">
                            <div class="single-shop-product">
                                <div class="product-upper">
                                    <img class="cate_img" src="<?= \yii\helpers\Url::to(Yii::$app->urlManagerBackend->baseUrl.'/product/'.$product->image,true)?>" alt="">
                                </div>
                                <h2><a href="<?= Url::to(['product/index','id'=>$product->id])?>"><?=$product->name?></a></h2>
                                <div class="product-carousel-price">
                                    <ins>$<?= number_format($product->price,0,',','.')?></ins>
                                </div>

                                <div class="product-option-shop">
                                    <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="<?= Url::to(['cart/add','id'=>$product->id])?>">Add to cart</a>
                                </div>
                            </div>
                        </div>
                     <?php endforeach;?>
                      <?php else:?>
                        <h2>Nothing to show</h2>
                     <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
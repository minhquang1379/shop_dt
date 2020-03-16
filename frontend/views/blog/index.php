<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
$this->title = 'Blog';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Blog</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
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

        <div class="row">
            <div class="col-md-12">
                <div class="product-pagination text-center">
                    <nav>
                      <?= LinkPager::widget([
                          'pagination' => $pagination,
                      ])?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
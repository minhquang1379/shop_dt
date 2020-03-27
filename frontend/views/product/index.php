<?php

use yii\helpers\Url;

$this->title = 'Product';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Product</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-content-right">

                    <div class="row">
                        <?php if (isset($product)):?>
                        <div class="col-sm-6">
                            <div class="product-images">
                                <div class="product-main-img">
                                    <img src="<?= Url::to(Yii::$app->urlManagerBackend->baseUrl.'/product/'.$product->image,true)?>" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="product-inner">
                                <h2 class="product-name"><?= $product->name?></h2>
                                <div class="product-inner-price">
                                    <ins>$<?= number_format($product->price,0,',','.')?></ins>
                                </div>

                                <form action="<?= Url::to(['cart/add'])?>" class="cart">
                                    <div class="quantity">
                                        <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                        <input type="hidden" name="id" value="<?= $product->id?>">
                                    </div>
                                    <?php if($product->inStock > 0):?>
                                    <button class="add_to_cart_button" type="submit">Add to cart</button>
                                    <?php else:?>
                                     <div class="btn btn-danger" >Out Of Stock</div>
                                    <?php endif;?>
                                </form>

                                <div class="product-inner-category">
                                   <ul>
                                       <li>Category <span class="primary"><?=$product->category->name?></span></li>
                                       <li>Unit <span class="primary"><?=$product->unit->name?></span></li>
                                       <li>Brand <span class="primary"><?=$product->brand->name?></span></li>
                                       <li>In Stock <span class="primary"><?=$product->inStock?></span></li>
                                   </ul>
                                </div>

                                <div role="tabpanel">
                                    <ul class="product-tab" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                                            <h2>Product Description</h2>
                                            <?= $product->description?>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="profile">
                                            <h2>Reviews</h2>
                                            <div class="submit-review">
                                                <p><label for="name">Name</label> <input name="name" type="text"></p>
                                                <p><label for="email">Email</label> <input name="email" type="email"></p>
                                                <div class="rating-chooser">
                                                    <p>Your rating</p>

                                                    <div id="star"></div>
                                                    <span class="stars">5</span>
                                                </div>
                                                <p><label for="review">Your review</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                                <p><input type="submit" value="Submit"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                    <div class="related-products-wrapper">
                        <h2 class="related-products-title">Same Category</h2>
                        <div class="related-products-carousel">
                            <?php if(isset($productInCate)):?>
                            <?php foreach ($productInCate as $product):?>
                            <div class="single-product text-center">
                                <div class="product-f-image">
                                    <img class="img_same_cate"  src="<?= Url::to(Yii::$app->urlManagerBackend->baseUrl.'/product/'.$product->image, true)?>" alt="">
                                    <div class="product-hover">
                                        <?php if($product->inStock > 0):?>
                                            <a href="<?= Url::to(['cart/add','id'=>$product->id])?>" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                        <?php else:?>
                                            <a class="btn btn-danger"><i class="fas fa-times"></i>   Out Of Stock</a>
                                        <?php endif;?>
                                        <a href="<?= Url::to(['product/index','id'=>$product->id])?>" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>

                                <h2><a href="<?= Url::to(['product/index','id'=>$product->id])?>"><?= $product->name?></a></h2>

                                <div class="product-carousel-price">
                                    <ins>$<?= number_format($product->price,0,',','.')?></ins>
                                </div>
                            </div>
                            <?php endforeach;?>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

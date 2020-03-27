<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Product';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Search Product</h2>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="single-sidebar">
                    <h2 class="sidebar-title text-center">Search</h2>
                    <div class="row">
                        <div class="col-sm-10">
                            <form class="row justify-content-center"  action="<?= Url::to(['/product/search'])?>">

                                <div class="form-group col-md-11 col-md-offset-1 align-center ">
                                    <label>Price</label>
                                    <input type="text" class="form-control"  placeholder="From">
                                    <input type="text" class="form-control" placeholder="To">
                                </div>
                                <div class="form-group col-md-11 col-md-offset-1 align-center ">
                                    <label for="">Category</label>
                                    <select name="category" class="form-control" id="">
                                        <?php if (isset($categories)):?>
                                            <?php foreach($categories as $category):?>
                                                <option value="<?= $category->id?>"><?= $category->name?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                </div>
                                <div class="form-group col-md-11 col-md-offset-1 align-center ">
                                    <label for="">Brand</label>
                                    <select name="category" class="form-control" id="">
                                        <?php if (isset($brands)):?>
                                            <?php foreach($brands as $brand):?>
                                                <option value="<?= $brand->id?>"><?= $brand->name?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                </div>
                                <div class="form-group col-md-11 col-md-offset-1 align-center ">
                                    <label for="">Supplier</label>
                                    <select name="category" class="form-control" id="">
                                        <?php if (isset($suppliers)):?>
                                            <?php foreach($suppliers as $supplier):?>
                                                <option value="<?= $supplier->id?>"><?= $supplier->name?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                </div>
                                <input type="submit" class="btn btn-warning center-block" value="Search" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="product-content-right">
                    <?php if (!empty($text)):?>
                        <h3 > <?= count($products)?> products  result for "<?= $text?>"</h3>
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
                                            <?php if($product->inStock > 0):?>
                                                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="<?= Url::to(['cart/add','id'=>$product->id])?>">Add to cart</a>
                                            <?php else:?>
                                                <a class="out_of_stock_button" >Out Of Stock</a>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        <?php else:?>
                            <h2>Nothing to show</h2>
                        <?php endif;?>
                    </div>
                    <?php if (isset($products)):?>
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
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>
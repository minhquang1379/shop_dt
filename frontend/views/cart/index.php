<?php
use yii\helpers\Url;

$this->title = 'Cart';
$this->params['breadcrumbs'] = $this->title;
?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shopping Cart</h2>
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
                    <div class="woocommerce">
                        <form action="<?= Url::to(['cart/update'])?>">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                <tr>
                                    <th class="product-remove">#</th>
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th>Status</th>
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($productInCart)):?>
                                        <?php
                                        $i = 1;
                                        foreach($productInCart as $cartItem):
                                            $product = $cartItem->getProduct();
                                            ?>
                                            <tr class="cart_item">
                                                <td class="product-remove">
                                                    <?= $i?>
                                                </td>

                                                <td class="product-thumbnail">
                                                    <a href="<?= Url::to(['product/index','id'=>$product->id])?>"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="<?= Url::to(Yii::$app->urlManagerBackend->baseUrl.'/product/'.$product->image, true)?>"></a>
                                                </td>

                                                <td class="product-name">
                                                    <a href="<?= Url::to(['product/index','id'=>$product->id])?>"><?= $product->name?></a>
                                                </td>

                                                <td class="product-price">
                                                    <span class="amount">$ <?= number_format($product->price,0,',','.')?></span>
                                                </td>

                                                <td class="product-quantity">
                                                    <div class="quantity buttons_added">
                                                        <input type="number" name="quantity[]" size="4" class="input-text qty text" title="Qty" value="<?=$cartItem->getQuantity()?>" min="0" step="1" max="<?= $product->inStock?>">
                                                        <input type="hidden" name="productId[]" value="<?=$product->id?>">
                                                        <input type="hidden" name="oldQuantity[]" value="<?=$cartItem->getQuantity()?>""  />
                                                    </div>
                                                </td>

                                                <td class="product-subtotal">
                                                    <span class="amount">$ <?=number_format($cartItem->getCost(),0,',','.')?></span>
                                                </td>
                                                <td>
                                                    <?php if($product->inStock > 0){
                                                        echo 'In Stock '.$product->inStock;
                                                    }else{
                                                        echo 'Out Of Stock';
                                                    }?>
                                                </td>
                                                <td >
                                                    <a title="Remove this item" class="btn btn-danger" href="<?= Url::to(['cart/delete','id'=>$product->id])?>">Remove</a>
                                                </td>
                                            </tr>
                                            <?php $i++;
                                        endforeach;?>
                                        <tr>
                                            <td class="actions" colspan="8">
                                                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken()?>">
                                                <button type="submit" name="update_cart" class="btn btn-primary">Update Cart</button>
                                            </td>
                                        </tr>
                                    <?php else:?>
                                        <tr>
                                            <td colspan="8">
                                                <div class="alert alert-warning"> Cart is empty</div>
                                                <a href="<?= Url::to(['category/index'])?>" class="btn btn-primary">Shop Now</a>
                                            </td>
                                        </tr>
                                    <?php endif;?>

                                </tbody>
                            </table>
                        </form>

                        <div class="cart-collaterals">

                            <div class="cart_totals ">
                                <?php
                                $cart = Yii::$app->cart;
                                if($cart->getTotalCount()):
                                    ?>
                                <h2>Cart Totals</h2>
                                <table cellspacing="0">
                                    <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Cart Subtotal</th>
                                        <td><span class="amount">$ <?= number_format($cart->getTotalCost(),0,',','.')?></span></td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td><a href="<?= Url::to(['cart/checkout'])?>" class="btn btn-success"> Check Out</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <?php endif;?>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

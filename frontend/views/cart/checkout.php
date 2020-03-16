<?php

use yii\helpers\Html; ?>
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
                    <h3 id="order_review_heading">Your order</h3>

                    <div id="order_review" style="position: relative;">
                        <table class="shop_table">
                            <thead>
                            <tr>
                                <th class="product-name">Product</th>
                                <th class="product-total">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($cartItems)):?>
                            <?php foreach($cartItems as $cartItem):
                                    $product = $cartItem->getProduct();
                            ?>
                            <tr class="cart_item">
                                <td class="product-name">
                                    <?= $product->name?> <strong class="product-quantity">x <?= $cartItem->getQuantity()?></strong> </td>
                                <td class="product-total">
                                    <span class="amount"> $ <?= number_format($cartItem->getCost(),0,',','.')?></span> </td>
                            </tr>
                            <?php endforeach;?>
                            <?php endif;?>
                            </tbody>
                            <tfoot>

                            <tr class="cart-subtotal">
                                <th>Cart Subtotal</th>
                                <td><span class="amount">
                                        <?php
                                            $cart = Yii::$app->cart;
                                            if($cart->getTotalCount()){
                                                echo '$ '.number_format($cart->getTotalCost(),0,',','.');
                                            }
                                        ?></span>
                                </td>
                            </tr>
                            <tr class="order-total">
                                <th>Order Total</th>
                                <td><strong><span class="amount">
                                             <?php
                                             $cart = Yii::$app->cart;
                                             if($cart->getTotalCount()){
                                                 echo '$ '.number_format($cart->getTotalCost(),0,',','.');
                                             }
                                             ?>
                                        </span></strong> </td>
                            </tr>

                            </tfoot>
                        </table>

                    </div>
                </div>
                <h3 id="order_review_heading">Different place</h3>

                <?php $form = \yii\widgets\ActiveForm::begin([
                        'method'=>'post',
                ])?>
                <?= $form->field($model,'receive_name')->textInput()?>
                <?= $form->field($model,'phone')->textInput()?>
                <?= $form->field($model,'address')->textInput()?>
                <?= Html::submitButton('Save',['class'=>'btn btn-primary'])?>
                <?php \yii\widgets\ActiveForm::end()?>
            </div>
        </div>
    </div>
</div>

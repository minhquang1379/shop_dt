<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>OrderDetail</h2>
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
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                <tr>
                                    <th>Receive</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Total</th>
                                    <th>Checkout at</th>
                                    <th class="">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($order)):?>
                                    <tr class="cart_item">
                                        <td><?=$order->receive_name?></td>
                                        <td><?=$order->address?></td>
                                        <td><?=$order->phone?></td>
                                        <td>$ <?= number_format($order->total,0,',','.')?></td>
                                        <th><?= date('y-m-d H:i:s',$order->create_at)?></th>
                                        <td><?= Html::a($order->getStatusCustomer()['name'],['order/status?id='.$order->id],[
                                                'class'=>$order->getStatusCustomer()['class'],
                                            ])?></td>
                                    </tr>
                                <?php endif;?>
                                </tbody>
                            </table>

                    </div>
                    <div id="order_review" style="position: relative;">
                        <table class="shop_table">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-total">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($orderDetails)):?>
                                <?php foreach($orderDetails as $orderDetail):
                                    $product = $orderDetail->product;
                                    ?>
                                    <tr class="cart_item">
                                        <td><?=Html::img(Url::to(Yii::$app->urlManagerBackend->baseUrl.'/product/'.$product->image,true))?> </td>
                                        <td class="product-name">
                                            <?= $product->name?> <strong class="product-quantity">x <?= $orderDetail->quantity?></strong> </td>
                                        <td class="product-total">
                                            <span class="amount"> $ <?= number_format($orderDetail->price *$orderDetail->quantity,0,',','.')?></span> </td>
                                    </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


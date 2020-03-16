<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Order Page</h2>
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
                                    <th class="">#</th>
                                    <th>Receive</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Total</th>
                                    <th>Checkout at</th>
                                    <th class="">Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($orders)):
                                    $i = 0;
                                    ?>
                                <?php foreach ($orders as $order):
                                    $i++;?>
                                        <tr class="cart_item">
                                           <td><?= $i?></td>
                                            <td><?=$order->receive_name?></td>
                                            <td><?=$order->address?></td>
                                            <td><?=$order->phone?></td>
                                            <td>$ <?= number_format($order->total,0,',','.')?></td>
                                            <th><?= date('y-m-d H:i:s',$order->create_at)?></th>
                                            <td><?= Html::a($order->getStatusCustomer()['name'],['order/status?id='.$order->id],[
                                                    'class'=>$order->getStatusCustomer()['class'],
                                                ])?></td>
                                            <td >
                                                <a class="btn btn-primary" href="<?= Url::to(['order/detail?id='.$order->id])?>">Detail</a>
                                                <?php if ($order->status == 3){
                                                    echo Html::a('Remove',['order/delete?id='.$order->id],[
                                                        'class'=>'btn btn-danger',
                                                    ]);
                                                }?>
                                            </td>
                                        </tr>
                                <?php endforeach;?>
                                <?php endif;?>
                                </tbody>
                            </table>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

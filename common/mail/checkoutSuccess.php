<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$orderLink = Yii::$app->urlManager->createAbsoluteUrl(['order/index', 'token' => $user->verification_token]);
?>
<div class="verify-email">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>Your checkout success!!!</p>
    <p>Total: <?= number_format($cart->getTotalCost(),0,',','.')?></p>
    <p>Quantity of product: <?=$cart->getTotalCount()?></p>
</div>

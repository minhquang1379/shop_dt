<?php

use yii\db\Migration;

/**
 * Class m200313_080738_orderDetail
 */
class m200313_080738_orderDetail extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order_detail',[
            'orderId'=>$this->integer(),
            'productId'=>$this->integer(),
            'price'=>$this->string(),
            'quantity'=>$this->integer(),
        ]);
        $this->addPrimaryKey('pk_orderDetail','order_detail',['orderId','productId']);
        $this->addForeignKey('fk_detail_order','order_detail','orderId','order','id','CASCADE');
        $this->addForeignKey('fk_detail_product','order_detail','productId','product','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200313_080738_orderDetail cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200313_080738_orderDetail cannot be reverted.\n";

        return false;
    }
    */
}

<?php

use yii\db\Migration;

/**
 * Class m200313_072710_cartItems
 */
class m200313_072710_cartItems extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cartItems',[
            'userId'=>$this->integer(),
            'productId'=>$this->integer(),
            'quantity'=>$this->integer(),
        ]);
        $this->addPrimaryKey('Pk_cartItems','cartItems',['userId','productId']);
        $this->addForeignKey('fk_cartItem_user','cartItems','userId','user','id');
        $this->addForeignKey('fk_cartItem_product','cartItems','productId','product','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200313_072710_cartItems cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200313_072710_cartItems cannot be reverted.\n";

        return false;
    }
    */
}

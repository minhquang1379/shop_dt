<?php

use yii\db\Migration;

/**
 * Class m200313_080241_order
 */
class m200313_080241_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order',[
            'id'=>$this->primaryKey(),
            'userId'=>$this->integer(),
            'total'=>$this->string(),
            'address'=>$this->string(),
            'phone'=>$this->string(),
            'status'=>$this->integer(),
            'receive_name'=>$this->string(),
            'is_delete'=>$this->integer()->defaultValue(0),
            'create_at'=>$this->integer(),
        ]);
        $this->addForeignKey('fk_order_user','order','userId','user','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200313_080241_order cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200313_080241_order cannot be reverted.\n";

        return false;
    }
    */
}

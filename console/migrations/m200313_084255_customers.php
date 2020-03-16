<?php

use yii\db\Migration;

/**
 * Class m200313_084255_customers
 */
class m200313_084255_customers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('customer',[
            'userId'=>$this->integer(),
            'name'=>$this->string(),
            'address'=>$this->string(),
            'phone'=>$this->string(),
            'create_at'=>$this->integer(),
            'updated_at'=>$this->integer(),
        ]);
        $this->addPrimaryKey('pk_customer','customer','userId');
        $this->addForeignKey('fk_customer_user','customer','userId','user','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200313_084255_customers cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200313_084255_customers cannot be reverted.\n";

        return false;
    }
    */
}

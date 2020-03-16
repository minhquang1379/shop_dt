<?php

use yii\db\Migration;

/**
 * Class m200309_020557_supplier
 */
class m200309_020557_supplier extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('supplier',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(),
            'address'=>$this->string(),
            'phone'=>$this->string(),
            'created_by'=>$this->integer(),
            'created_at'=>$this->integer(),
            'updated_by'=>$this->integer(),
            'updated_at'=>$this->integer(),
        ]);
        $this->addForeignKey('FK_suppliers_create_user','supplier','created_by','user','id');
        $this->addForeignKey('FK_suppliers_update_user','supplier','updated_by','user','id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200309_020557_supplier cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200309_020557_supplier cannot be reverted.\n";

        return false;
    }
    */
}

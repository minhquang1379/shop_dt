<?php

use yii\db\Migration;

/**
 * Class m200309_021238_brand
 */
class m200309_021238_brand extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('brand',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(),
            'image'=>$this->string(),
            'created_by'=>$this->integer(),
            'created_at'=>$this->integer(),
            'updated_by'=>$this->integer(),
            'updated_at'=>$this->integer(),
        ]);
        $this->addForeignKey('FK_brand_create_user','brand','created_by','user','id');
        $this->addForeignKey('FK_brand_update_user','brand','updated_by','user','id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200309_021238_brand cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200309_021238_brand cannot be reverted.\n";

        return false;
    }
    */
}

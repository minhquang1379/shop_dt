<?php

use yii\db\Migration;

/**
 * Class m200311_103914_slider
 */
class m200311_103914_slider extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('slider',[
            'id'=>$this->primaryKey(),
            'title'=>$this->string(),
            'caption'=>$this->string(),
            'image'=>$this->string(),
            'is_active'=>$this->integer(),
            'created_by'=>$this->integer(),
            'created_at'=>$this->integer(),
            'updated_by'=>$this->integer(),
            'updated_at'=>$this->integer(),
        ]);
        $this->addForeignKey('FK_slider_create_user','slider','created_by','user','id');
        $this->addForeignKey('FK_slider_update_user','slider','updated_by','user','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200311_103914_slider cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200311_103914_slider cannot be reverted.\n";

        return false;
    }
    */
}

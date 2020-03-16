<?php

use yii\db\Migration;

/**
 * Class m200306_033019_category
 */
class m200306_033019_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(),
            'parent'=>$this->integer(),
            'created_by'=>$this->integer(),
            'created_at'=>$this->integer(),
            'updated_by'=>$this->integer(),
            'updated_at'=>$this->integer(),
        ]);
        $this->addForeignKey('Fk_cate_create_user','category','created_by','user','id');
        $this->addForeignKey('Fk_cate_update_user','category','updated_by','user','id');
        $this->addForeignKey('fk_cate_parent','category','parent','category','id','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200306_033019_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200306_033019_category cannot be reverted.\n";

        return false;
    }
    */
}

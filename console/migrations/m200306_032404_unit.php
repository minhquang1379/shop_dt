<?php

use yii\db\Migration;

/**
 * Class m200306_032404_unit
 */
class m200306_032404_unit extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('unit',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(),
            'created_at'=>$this->integer(),
            'created_by'=>$this->integer(),
            'updated_at'=>$this->integer(),
            'updated_by'=>$this->integer(),
        ]);
        $this->addForeignKey('Fk_unit_create_user','unit','created_by','user','id');
        $this->addForeignKey('Fk_unit_update_user','unit','updated_by','user','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200306_032404_unit cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200306_032404_unit cannot be reverted.\n";

        return false;
    }
    */
}

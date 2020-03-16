<?php

use yii\db\Migration;

/**
 * Class m200305_015528_manage_controller
 */
class m200305_015528_manage_controller extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('manage_controller',[
            'id'=>$this->primaryKey(),
            'controller_id'=>$this->string(255),
            'module_name'=>$this->string(255),
            'alias_name'=>$this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200305_015528_manage_controller cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200305_015528_manage_controller cannot be reverted.\n";

        return false;
    }
    */
}

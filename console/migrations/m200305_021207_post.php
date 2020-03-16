<?php

use yii\db\Migration;

/**
 * Class m200305_021207_post
 */
class m200305_021207_post extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('post',[
            'id'=>$this->primaryKey(),
            'title'=>$this->string(),
            'thumbnail'=>$this->string(),
            'content'=>$this->text(),
            'shortDescription'=>$this->string(),
            'like'=>$this->integer(),
            'views'=>$this->integer(),
            'created_by'=>$this->integer(),
            'created_at'=>$this->integer(),
            'updated_by'=>$this->integer(),
            'updated_at'=>$this->integer(),
        ]);
        $this->addForeignKey('FK_post_create_user','post','created_by','user','id');
        $this->addForeignKey('FK_post_update_user','post','updated_by','user','id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200305_021207_post cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200305_021207_post cannot be reverted.\n";

        return false;
    }
    */
}

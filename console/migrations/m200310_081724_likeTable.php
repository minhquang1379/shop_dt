<?php

use yii\db\Migration;

/**
 * Class m200310_081724_likeTable
 */
class m200310_081724_likeTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('likeTable',[
            'postId'=>$this->integer(),
            'userId'=>$this->integer(),
            'created_at'=>$this->integer(),
        ]);
        $this->addPrimaryKey('Pk_likeTable','likeTable',['postId','userId']);
        $this->addForeignKey('Fk_like_post','likeTable','postId','post','id');
        $this->addForeignKey('Fk_like_user','likeTable','userId','user','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200310_081724_likeTable cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200310_081724_likeTable cannot be reverted.\n";

        return false;
    }
    */
}

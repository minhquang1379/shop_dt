<?php

use yii\db\Migration;

/**
 * Class m200317_090415_comment_blog
 */
class m200317_090415_comment_blog extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comment_blog',[
            'id'=>$this->primaryKey(),
            'blogId'=>$this->integer(),
            'userId'=>$this->integer(),
            'content'=>$this->text(),
            'parentId'=>$this->integer(),
            'created_at'=>$this->integer(),
        ]);
        $this->addForeignKey('fk_comment_blog','comment_blog','blogId','post','id');
        $this->addForeignKey('fk_comment_user','comment_blog','userId','user','id');
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200317_090415_comment_blog cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200317_090415_comment_blog cannot be reverted.\n";

        return false;
    }
    */
}

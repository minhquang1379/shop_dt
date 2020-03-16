<?php

use yii\db\Migration;

/**
 * Class m200312_091055_reviews
 */
class m200312_091055_reviews extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('reviews_product',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(),
            'email'=>$this->string(),
            'content'=>$this->text(),
            'rating'=>$this->integer(),
            'likes'=>$this->integer(),
            'dislike'=>$this->integer(),
            'parentId'=>$this->integer(),
            'productId'=>$this->integer(),
            'created_at'=>$this->time(),
        ]);
        $this->addForeignKey('fk_parent_review_product','reviews_product','parentId','reviews_product','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200312_091055_reviews cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200312_091055_reviews cannot be reverted.\n";

        return false;
    }
    */
}

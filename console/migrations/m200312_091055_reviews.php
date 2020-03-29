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
            'userId'=>$this->integer(),
            'content'=>$this->text(),
            'rating'=>$this->integer(),
            'productId'=>$this->integer(),
            'created_at'=>$this->integer(),
        ]);
        $this->addForeignKey('fk_reviews_product_user','reviews_product','userId','user','id','CASCADE');
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

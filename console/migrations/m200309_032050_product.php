<?php

use yii\db\Migration;

/**
 * Class m200309_032050_product
 */
class m200309_032050_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(),
            'price'=>$this->string(),
            'image'=>$this->string(),
            'description'=>$this->text(),
            'inStock'=>$this->integer(),
            'inOrder'=>$this->integer(),
            'inCart'=>$this->integer(),
            'unitId'=>$this->integer(),
            'brandId'=>$this->integer(),
            'categoryID'=>$this->integer(),
            'supplierId'=>$this->integer(),
            'created_by'=>$this->integer(),
            'created_at'=>$this->integer(),
            'updated_by'=>$this->integer(),
            'updated_at'=>$this->integer(),
        ]);
        $this->addForeignKey('FK_product_create_user','product','created_by','user','id');
        $this->addForeignKey('FK_product_update_user','product','updated_by','user','id');
        $this->addForeignKey('Fk_product_unit','product','unitId','unit','id');
        $this->addForeignKey('Fk_product_brand','product','brandId','brand','id');
        $this->addForeignKey('Fk_product_supplier','product','supplierId','supplier','id');
        $this->addForeignKey('Fk_product_category','product','categoryId','category','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200309_032050_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200309_032050_product cannot be reverted.\n";

        return false;
    }
    */
}

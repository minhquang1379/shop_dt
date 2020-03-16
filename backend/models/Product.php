<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $price
 * @property string|null $image
 * @property int|null $inStock
 * @property int|null $inOrder
 * @property int|null $inCart
 * @property int|null $unitId
 * @property int|null $brandId
 * @property int|null $supplierId
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $updated_by
 * @property int|null $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property Brand $brand
 * @property Supplier $supplier
 * @property Unit $unit
 */
class Product extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inStock'], 'integer'],
            [['name','price','description'],'required'],
            [['name', 'price'], 'string', 'max' => 255],
            [['price'],'match','pattern'=>'/^[^a-zA-Z\/-]*$/'],
            [['image'],'image','skipOnEmpty'=>false, 'on'=>self::SCENARIO_CREATE],
            [['image'],'image','on'=>self::SCENARIO_UPDATE],
            [['brandId','unitId','supplierId'],'default','value'=>null],
            [['name'],'unique','targetAttribute'=>'name'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'image' => 'Image',
            'inStock' => 'In Stock',
            'inOrder' => 'In Order',
            'inCart' => 'In Cart',
            'unitId' => 'Unit',
            'brandId' => 'Brand',
            'categoryId'=>'Category',
            'supplierId' => 'Supplier',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[Brand]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brandId']);
    }

    /**
     * Gets query for [[Supplier]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'supplierId']);
    }

    /**
     * Gets query for [[Unit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['id' => 'unitId']);
    }
    public function getCategory(){
        return $this->hasOne(Category::className(),['id'=>'categoryId']);
    }
    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ['name','price','inStock','unitId','brandId','supplierId','categoryId','image', 'description'],
            self::SCENARIO_UPDATE => ['name','price','inStock','unitId','brandId','supplierId','categoryId','image', 'description']
        ];
    }
    //get array of brands
    public function getBrandDropdownList(){
        $array[null] = 'None';
        $arrayModel = ArrayHelper::map(Brand::find()->all(),'id','name');
        $array = ArrayHelper::merge($array,$arrayModel);
        return $array;
    }
    //get array of unit
    public function getUnitDropdownList(){
        $array[null] = 'None';
        $arrayModel = ArrayHelper::map(Unit::find()->all(),'id','name');
        $array = ArrayHelper::merge($array,$arrayModel);
        return $array;
    }
    //get array of supplier
    public function getSupplierDropdownList(){
        $array[null] = 'None';
        $arrayModel = ArrayHelper::map(Supplier::find()->all(),'id','name');
        $array = ArrayHelper::merge($array,$arrayModel);
        return $array;
    }
    //upload image return boolean
    public function uploadImage(){
        //check image != null
        if($this->image){
            //hashing name of image by md5
            $name = md5(time().$this->image->baseName);
            //save image to web/upload/product
            $this->image->saveAs('upload/product/'.$name.'.'.$this->image->extension);
            $this->image = $name.'.'.$this->image->extension;
            return true;
        }
        return false;
    }
    public function getCategoryDropdownList(){
        $model = new Category();

        return $model->getDropdownlist();
    }
}

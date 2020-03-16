<?php

namespace backend\models;

use common\models\User;
use http\Url;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $parent
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $updated_by
 * @property int|null $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property Category $parent0
 * @property Category[] $categories
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['name'],'required'],
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
            'parent' => 'Parent',
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
     * Gets query for [[Parent0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['parent' => 'id']);
    }
    public function getProducts(){
        return $this->hasMany(Product::className(),['categoryId'=>'id']);
    }
    public function getAllCategory(){
        $cates = Category::find()->where(['parent' => null])->all();
        echo '<ul class="cat_menu" >';
        foreach ($cates as $cate){
            if(!empty($cate->categories)){
                echo '<li class="hassubs" ><a href="#">'.$cate->name.'<i class="fas fa-chevron-right"></i></a>';
            }else{
                echo '<li><a href="#">'.$cate->name.'<i class="fas fa-chevron-right"></i></a>';
            }

            $cate->getChild($cate->id);
            echo '</li>';
        }
        echo '</ul>';
    }
    public function getChild($id){
        $childs = Category::find()->where(['parent'=>$id])->all();
        if($childs){
            echo '<ul>';
            foreach($childs as $cate){
                if(!empty($cate->categories)){
                    echo '<li class="hassubs" ><a href="#">'.$cate->name.'<i class="fas fa-chevron-right"></i></a>';
                }else{
                    echo '<li><a href="#">'.$cate->name.'<i class="fas fa-chevron-right"></i></a>';
                }

                $this->getChild($cate->id);
                echo '</li>';
            }
            echo '</ul>';
        }
    }
    public function getMenuCategory($id = 0){
        if(!$id){
            $cates = Category::find()->where(['parent' => null])->all();
        }else{
            $cates = Category::find()->where(['parent' => $id])->all();
        }
        if($cates){
            echo '<ul class="cate_menu">';
            foreach ($cates as $cate){
                if(!empty($cate->categories)){
                    echo '<li><a href="'.\yii\helpers\Url::to(['category/index','id'=>$cate->id]).'">'.$cate->name.'<i class="fas fa-chevron-right"></i></a>';
                }else{
                    echo '<li><a href="'.\yii\helpers\Url::to(['category/index','id'=>$cate->id]).'">'.$cate->name.'</a>';
                }

                $cate->getMenuCategory($cate->id);
                echo '</li>';
            }
            echo '</ul>';
        }
    }
    public function getDropdownlist(){
        $array[null] = 'None';
        $id = $this->id != null? $this->id: 0;
        $arrayModel = ArrayHelper::map(Category::find()->where(['!=','id',$id])->all(),'id','name');
        $array = ArrayHelper::merge($array , $arrayModel);
        return $array;
    }
}

<?php

namespace backend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $image
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $updated_by
 * @property int|null $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Brand extends \yii\db\ActiveRecord
{
    const SCENARIO_CREAT = 'create';
    const SCENARIO_UPDATE = 'update';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['name'],'required' ],
            [['name'],'unique','targetAttribute'=>'name'],
            [['image'],'image', 'skipOnEmpty'=>false , 'on'=>self::SCENARIO_CREAT ],
            ['image','image','on'=>self::SCENARIO_UPDATE],
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
            'image' => 'Image',
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
    public function uploadImage(){
        if($this->image){
            $name = md5(time().$this->image->baseName);
            $this->image->saveAs('upload/brand/'.$name.'.'.$this->image->extension);
            $this->image = $name.'.'.$this->image->extension;
            return true;
        }
        return false;
    }
    public function scenarios()
    {
        return [
            self::SCENARIO_CREAT => ['name','image'],
            self::SCENARIO_UPDATE => ['name','image'],
        ];
    }
}

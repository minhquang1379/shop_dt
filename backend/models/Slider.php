<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "slider".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $caption
 * @property string|null $image
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $updated_by
 * @property int|null $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Slider extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    public $status = [
        0=>[
            'name'=>'Inactive',
            'class'=>'danger'
        ],
        1=>[
          'name'=>'Active',
          'class'=>'primary'
        ],
    ];
    public $active;
    public function init()
    {
        $this->active[0]='inactive';
        $this->active[1]='active';
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'slider';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'caption'], 'string', 'max' => 255],
            [['title','caption'],'required'],
            [['image'],'image','skipOnEmpty'=>false, 'on'=>self::SCENARIO_CREATE],
            [['image'],'image','on'=>self::SCENARIO_UPDATE],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'caption' => 'Caption',
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
    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE =>['title','caption','image','is_active'],
            self::SCENARIO_UPDATE=>['title','caption','image','is_active'],
        ];
    }
    public function uploadImage(){
        if($this->image){
            $name = md5(time().$this->image->baseName);
            $this->image->saveAs('upload/slider/'.$name.'.'.$this->image->extension);
            $this->image = $name.'.'.$this->image->extension;
            return true;
        }
        return false;
    }
    public function getActive(){
        return $this->active;
    }
    public function getStatus(){
        return ArrayHelper::getValue($this->status,$this->is_active);
    }

}

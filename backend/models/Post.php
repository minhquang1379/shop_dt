<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $thumbnail
 * @property string|null $content
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $updated_by
 * @property int|null $updated_at
 *
 * @property User $createdBy
 * @property User $createdBy0
 */
class Post extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    /**
     * {@inheritdoc}
     */
    public $file;
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
            [['content'],'string','min'=>100],
            ['thumbnail','image','skipOnEmpty'=>false, 'on'=>self::SCENARIO_CREATE],
            ['thumbnail','image','on'=>self::SCENARIO_UPDATE],
            [['title','content','shortDescription'],'required' ],
            [['title'],'unique','targetAttribute'=>'title'],
            [['shortDescription'],'string','max'=>120],
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
            'content' => 'Content',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'thumbnail'=>'Thumbnail',
            'shortDescription`'=>'Description'
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
     * Gets query for [[CreatedBy0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
    public function uploadImage()
    {
        //check image != null
        if($this->thumbnail){
            //hashing name of image by md5
            $name = md5(time().$this->thumbnail->baseName);
            $this->thumbnail->saveAs('upload/post/'.$name.$this->thumbnail->extension);
            $this->thumbnail = $name.$this->thumbnail->extension;
            return true;
        }else{
            return false;
        }
    }
    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE =>['title','content','thumbnail','shortDescription'],
            self::SCENARIO_UPDATE => ['title','content','thumbnail','shortDescription'],
        ];
    }
    public function upView(){
        $this->views++;
        $this->save(false);
    }
}

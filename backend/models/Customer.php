<?php

namespace backend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $userId
 * @property string|null $name
 * @property string|null $address
 * @property string|null $phone
 * @property int|null $create_at
 * @property int|null $updated_at
 *
 * @property User $user
 */
class Customer extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','address','phone'],'required'],
            [['name', 'address'], 'string', 'max' => 255],
            ['phone','match','pattern'=>'/^[^a-zA-Z]*$/'],
            [['phone'],'string','max'=>12,'min'=>10],
            [['image'],'image','skipOnEmpty'=>false,'on'=>self::SCENARIO_CREATE],
            [['image'],'image','on'=>self::SCENARIO_UPDATE],


        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'userId' => 'User ID',
            'name' => 'Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'create_at' => 'Create At',
            'updated_at' => 'Updated At',
            'image'=>'Avatar'
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
    public function scenarios()
    {
        return [
            self::SCENARIO_UPDATE =>['name','address','phone','image'],
            self::SCENARIO_CREATE =>['name','address','phone','image'],
        ];
    }
    public function uploadImage(){
        if($this->image){
            $name = md5(time().$this->image->baseName);
            $this->image->saveAs('upload/avatar/'.$name.'.'.$this->image->extension);
            $this->image = $name.'.'.$this->image->extension;
            return true;
        }
        return false;
    }
}

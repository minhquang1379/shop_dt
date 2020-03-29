<?php

namespace backend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "reviews_product".
 *
 * @property int $id
 * @property int|null $userId
 * @property string|null $content
 * @property int|null $rating
 * @property int|null $productId
 * @property string|null $created_at
 *
 * @property User $user
 */
class ReviewsProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'rating', 'productId'], 'integer'],
            [['content'], 'string'],
            [['created_at'], 'safe'],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'content' => 'Content',
            'rating' => 'Rating',
            'productId' => 'Product ID',
            'created_at' => 'Created At',
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
    public function getUserInfo(){
        return $this->hasOne(Customer::className(),['userId'=>'userId']);
    }
    public function getAvatar(){
        $customer = Customer::findOne(['userId'=>$this->user->id]);
        if($customer){
            return $customer->image;
        }
        return false;
    }
}

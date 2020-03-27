<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "liketable".
 *
 * @property int $postId
 * @property int $userId
 * @property int|null $created_at
 *
 * @property Post $post
 * @property User $user
 */
class LikeTable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'liketable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['postId', 'userId'], 'required'],
            [['postId', 'userId', 'created_at'], 'integer'],
            [['postId', 'userId'], 'unique', 'targetAttribute' => ['postId', 'userId']],
            [['postId'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['postId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'postId' => 'Post ID',
            'userId' => 'User ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'postId']);
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
}

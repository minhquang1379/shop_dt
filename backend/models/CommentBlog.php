<?php

namespace backend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "comment_blog".
 *
 * @property int $id
 * @property int|null $blogId
 * @property int|null $userId
 * @property string|null $content
 * @property int|null $parentId
 * @property int|null $created_at
 *
 * @property Post $blog
 * @property User $user
 * @property CommentBlog $parent
 * @property CommentBlog[] $commentBlogs
 */
class CommentBlog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment_blog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['blogId', 'userId', 'created_at'], 'integer'],
            [['content'], 'string'],
            [['blogId'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['blogId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'blogId' => 'Blog ID',
            'userId' => 'User ID',
            'content' => 'Content',
            'parentId' => 'Parent ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Blog]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlog()
    {
        return $this->hasOne(Post::className(), ['id' => 'blogId']);
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

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(CommentBlog::className(), ['id' => 'parentId']);
    }

    /**
     * Gets query for [[CommentBlogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommentBlogs()
    {
        return $this->hasMany(CommentBlog::className(), ['parentId' => 'id']);
    }
    public function getAvatar(){
        $customer = Customer::findOne(['userId'=>$this->user->id]);
        if($customer){
            return $customer->image;
        }
        return false;
    }
}

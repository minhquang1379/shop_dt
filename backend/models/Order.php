<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int|null $userId
 * @property string|null $total
 * @property string|null $address
 * @property string|null $phone
 * @property int|null $status
 * @property int|null $receive_name
 * @property int|null $create_at
 *
 * @property User $user
 * @property OrderDetail[] $orderDetails
 */
class Order extends \yii\db\ActiveRecord
{
    public $customerStatus = [
        0=>[
            'name'=>'Pending',
            'class'=>'btn btn-warning disable_link',
        ],
        1=>[
            'name'=>'Shipping',
            'class'=>'btn btn-info disable_link',
        ],
        2=>[
            'name'=>'Received',
            'class'=>'btn btn-primary disable_link'
        ],
        3=>[
            'name'=>'Complete',
            'class'=>'btn btn-primary disable_link'
        ],
    ];
    public $statusOrder;
    public function init()
    {
        $this->statusOrder[0]='Pending';
        $this->statusOrder[1]='Processing';
        $this->statusOrder[2]='Shipped';
        $this->statusOrder[3]='Paid';
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'address', 'receive_name'], 'string', 'max' => 255],
            [['address','receive_name','phone'], 'required'],
            [['phone'],'string','max'=>12,'min'=>10],
            ['phone','match','pattern'=>'/^[^a-zA-Z]*$/'],
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
            'total' => 'Total',
            'address' => 'Address',
            'phone' => 'Phone',
            'status' => 'Status',
            'receive_name' => 'Receive Name',
            'create_at' => 'Create At',
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

    /**
     * Gets query for [[OrderDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetail::className(), ['orderId' => 'id']);
    }
    public function getStatusAdmin(){
        return ArrayHelper::getValue($this->adminStatus,$this->status);
    }
    public function getStatusCustomer(){
        return ArrayHelper::getValue($this->customerStatus,$this->status);
    }
    public function sendMail(){
        $user = User::findOne(['id'=>Yii::$app->user->getId()]);
        $cart = Yii::$app->cart;
        Yii::$app
            ->mailer
            ->compose(
                ['html' => '@common/mail/checkoutSuccess'],
                [
                    'user' => $user,
                    'cart'=>$cart,
                ]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($user->email)
            ->setSubject('Your order in ' . Yii::$app->name)
            ->send();
    }
    public function getStatus(){
        return $this->statusOrder;
    }
}

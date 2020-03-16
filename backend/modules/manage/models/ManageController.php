<?php

namespace backend\modules\manage\models;

use Yii;

/**
 * This is the model class for table "manage_controller".
 *
 * @property int $id
 * @property string|null $controller_id
 * @property string|null $module_name
 * @property string|null $alias_name
 */
class ManageController extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'manage_controller';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['controller_id', 'module_name', 'alias_name'], 'string', 'max' => 255],
            [['controller_id', 'module_name'],'unique','targetAttribute'=>['controller_id','module_name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'controller_id' => 'Controller ID',
            'module_name' => 'Module Name',
            'alias_name' => 'Alias Name',
        ];
    }
}

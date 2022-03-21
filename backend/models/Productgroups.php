<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_groups".
 *
 * @property int $id
 * @property string $product_group
 * @property int $status
 */
class Productgroups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_group'], 'required'],
            [['status'], 'integer'],
            [['product_group'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_group' => 'Product Group',
            'status' => 'Status',
        ];
    }
}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "end_of_day_figures".
 *
 * @property int $id
 * @property int $user_id
 * @property string $timestamp
 * @property float $just_eat_total_orders
 * @property float $just_eat_total_sales
 * @property float $uber_eats_total_orders
 * @property float $uber_eats_total_sales
 * @property float $deliveroo_total_orders
 * @property float $deliveroo_total_sales
 * @property float $wix_total_orders
 * @property float $wix_total_sales
 * @property float $zettle_total_orders
 * @property float $zettle_total_sales
 *
 * @property User $user
 */
class Endofdayfigures extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'end_of_day_figures';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'just_eat_total_orders', 'just_eat_total_sales', 'uber_eats_total_orders', 'uber_eats_total_sales', 'deliveroo_total_orders', 'deliveroo_total_sales', 'wix_total_orders', 'wix_total_sales', 'zettle_total_orders', 'zettle_total_sales'], 'required'],
            [['user_id'], 'integer'],
            [['timestamp'], 'safe'],
            [['just_eat_total_orders', 'just_eat_total_sales', 'uber_eats_total_orders', 'uber_eats_total_sales', 'deliveroo_total_orders', 'deliveroo_total_sales', 'wix_total_orders', 'wix_total_sales', 'zettle_total_orders', 'zettle_total_sales'], 'number'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'timestamp' => 'Timestamp',
            'just_eat_total_orders' => 'Just Eat Total Orders',
            'just_eat_total_sales' => 'Just Eat Total Sales',
            'uber_eats_total_orders' => 'Uber Eats Total Orders',
            'uber_eats_total_sales' => 'Uber Eats Total Sales',
            'deliveroo_total_orders' => 'Deliveroo Total Orders',
            'deliveroo_total_sales' => 'Deliveroo Total Sales',
            'wix_total_orders' => 'Wix Total Orders',
            'wix_total_sales' => 'Wix Total Sales',
            'zettle_total_orders' => 'Zettle Total Orders',
            'zettle_total_sales' => 'Zettle Total Sales',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

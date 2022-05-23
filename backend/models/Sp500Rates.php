<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sp500_rates".
 *
 * @property int $id
 * @property int|null $year
 * @property float|null $rate
 */
class Sp500rates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sp500_rates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year'], 'integer'],
            [['rate'], 'number'],
            [['year'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year' => 'Year',
            'rate' => 'Rate',
        ];
    }
}

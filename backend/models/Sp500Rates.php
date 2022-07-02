<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sp500_rates".
 *
 * @property int $id
 * @property int|null $year
 * @property float|null $return
 * @property float $january
 * @property float $february
 * @property float $march
 * @property float $april
 * @property float $may
 * @property float $june
 * @property float $july
 * @property float $august
 * @property float $september
 * @property float $october
 * @property float $november
 * @property float $december
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
            [['return', 'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'], 'number'],
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
            'return' => 'Return',
            'january' => 'January',
            'february' => 'February',
            'march' => 'March',
            'april' => 'April',
            'may' => 'May',
            'june' => 'June',
            'july' => 'July',
            'august' => 'August',
            'september' => 'September',
            'october' => 'October',
            'november' => 'November',
            'december' => 'December',
        ];
    }
}

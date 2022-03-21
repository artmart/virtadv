<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Endofdayfigures;

/**
 * EndofdayfiguresSearch represents the model behind the search form of `backend\models\Endofdayfigures`.
 */
class EndofdayfiguresSearch extends Endofdayfigures
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['timestamp'], 'safe'],
            [['just_eat_total_orders', 'just_eat_total_sales', 'uber_eats_total_orders', 'uber_eats_total_sales', 'deliveroo_total_orders', 'deliveroo_total_sales', 'wix_total_orders', 'wix_total_sales', 'zettle_total_orders', 'zettle_total_sales'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Endofdayfigures::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'timestamp' => $this->timestamp,
            'just_eat_total_orders' => $this->just_eat_total_orders,
            'just_eat_total_sales' => $this->just_eat_total_sales,
            'uber_eats_total_orders' => $this->uber_eats_total_orders,
            'uber_eats_total_sales' => $this->uber_eats_total_sales,
            'deliveroo_total_orders' => $this->deliveroo_total_orders,
            'deliveroo_total_sales' => $this->deliveroo_total_sales,
            'wix_total_orders' => $this->wix_total_orders,
            'wix_total_sales' => $this->wix_total_sales,
            'zettle_total_orders' => $this->zettle_total_orders,
            'zettle_total_sales' => $this->zettle_total_sales,
        ]);

        return $dataProvider;
    }
}

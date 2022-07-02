<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Sp500rates;

/**
 * Sp500ratesSearch represents the model behind the search form of `backend\models\Sp500rates`.
 */
class Sp500ratesSearch extends Sp500rates
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'year'], 'integer'],
            [['return', 'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'], 'number'],
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
        $query = Sp500rates::find();

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
            'year' => $this->year,
            'return' => $this->return,
            'january' => $this->january,
            'february' => $this->february,
            'march' => $this->march,
            'april' => $this->april,
            'may' => $this->may,
            'june' => $this->june,
            'july' => $this->july,
            'august' => $this->august,
            'september' => $this->september,
            'october' => $this->october,
            'november' => $this->november,
            'december' => $this->december,
        ]);

        return $dataProvider;
    }
}

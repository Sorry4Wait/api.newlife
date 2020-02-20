<?php

namespace app\modules\icase\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\icase\models\InsProductsCalculation;

/**
 * InsProductsCalculationSearch represents the model behind the search form of `app\modules\icase\models\InsProductsCalculation`.
 */
class InsProductsCalculationSearch extends InsProductsCalculation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_products', 'id_calculation_type', 'calculation_percentage'], 'integer'],
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
        $query = InsProductsCalculation::find();

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
            'id_products' => $this->id_products,
            'id_calculation_type' => $this->id_calculation_type,
            'calculation_percentage' => $this->calculation_percentage,
        ]);

        return $dataProvider;
    }
}

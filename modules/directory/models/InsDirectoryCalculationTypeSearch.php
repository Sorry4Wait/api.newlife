<?php

namespace app\modules\directory\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\directory\models\InsDirectoryCalculationType;

/**
 * InsDirectoryCalculationTypeSearch represents the model behind the search form of `app\modules\directory\models\InsDirectoryCalculationType`.
 */
class InsDirectoryCalculationTypeSearch extends InsDirectoryCalculationType
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_product_type'], 'integer'],
            [['name_uz', 'name_ru'], 'safe'],
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
        $query = InsDirectoryCalculationType::find();

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
            'id_product_type' => $this->id_product_type,
        ]);

        $query->andFilterWhere(['ilike', 'name_uz', $this->name_uz])
            ->andFilterWhere(['ilike', 'name_ru', $this->name_ru]);

        return $dataProvider;
    }
}

<?php

namespace app\modules\icase\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\icase\models\InsProductsAppform;

/**
 * InsProductsAppformSearch represents the model behind the search form of `app\modules\icase\models\InsProductsAppform`.
 */
class InsProductsAppformSearch extends InsProductsAppform
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_ins_products', 'id_directory_appform'], 'integer'],
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
        $query = InsProductsAppform::find();

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
            'id_ins_products' => $this->id_ins_products,
            'id_directory_appform' => $this->id_directory_appform,
        ]);

        return $dataProvider;
    }
}

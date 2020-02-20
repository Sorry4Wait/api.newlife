<?php

namespace app\modules\icase\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\icase\models\InsProducts;

/**
 * InsProductsSearch represents the model behind the search form of `app\modules\icase\models\InsProducts`.
 */
class InsProductsSearch extends InsProducts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_product_type', 'id_product_kind', 'who_create', 'who_approve', 'id_product_status', 'id_product_prefix'], 'integer'],
            [['name_uz', 'name_ru', 'date_create', 'date_approve', 'description', 'un_code'], 'safe'],
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
        $query = InsProducts::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
//        $dataProvider->setSort([
//            'attributes' => [
//                'id',
//                'nameCurrentLanguage',
//                'id_product_type',
//                'id_product_kind',
//                'id_product_prefix',
//                'id_product_status'
//            ]
//        ]);

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
            'id_product_kind' => $this->id_product_kind,
            'who_create' => $this->who_create,
            'date_create' => $this->date_create,
            'who_approve' => $this->who_approve,
            'date_approve' => $this->date_approve,
            'id_product_status' => $this->id_product_status,
            'id_product_prefix' => $this->id_product_prefix,
        ]);

        $query->andFilterWhere(['ilike', 'name_uz', $this->name_uz])
            ->andFilterWhere(['ilike', 'name_ru', $this->name_ru])
            ->andFilterWhere(['ilike', 'description', $this->description])
            ->andFilterWhere(['ilike', 'un_code', $this->un_code]);

        return $dataProvider;
    }
}

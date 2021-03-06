<?php

namespace app\modules\report\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\report\models\PcciReportsLink;

/**
 * PcciReportsLinkSearch represents the model behind the search form of `app\modules\report\models\PcciReportsLink`.
 */
class PcciReportsLinkSearch extends PcciReportsLink
{

    public function afterFind()
    {
        parent::afterFind(); // TODO: Change the autogenerated stub
        $this->create_date = date('d.m.Y', strtotime(str_replace("-", "", $this->create_date)));
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'creator_id', 'reports_id'], 'integer'],
            [['link', 'create_date'], 'safe'],
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
        $query = PcciReportsLink::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'totalCount' => false
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
            'create_date' => $this->create_date,
            'creator_id' => $this->creator_id,
            'reports_id' => $this->reports_id,
        ]);

        $query->andFilterWhere(['ilike', 'link', $this->link]);
        $query->orderBy('create_date desc');

        return $dataProvider;
    }
}

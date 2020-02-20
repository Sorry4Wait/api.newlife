<?php

namespace app\modules\icase\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\icase\models\InsInsuredClients;

/**
 * InsInsuredClientsSearch represents the model behind the search form of `app\modules\icase\models\InsInsuredClients`.
 */
class InsInsuredClientsSearch extends InsInsuredClients
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'lang_id', 'birth_place_id', 'birth_country_id', 'livestatus', 'nationality_id', 'citizenship_id', 'sex', 'doc_give_place_id', 'who_registred', 'citizen_status'], 'integer'],
            [['document', 'pinpp', 'name_latin', 'surname_latin', 'patronym_latin', 'name_engl', 'surname_engl', 'birth_date', 'birth_place', 'birth_country', 'nationality', 'citizenship', 'doc_give_place', 'date_begin_document', 'date_end_document', 'inn', 'create_date', 'address', 'phone', 'email', 'work_place'], 'safe'],
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
        $query = InsInsuredClients::find();

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
            'lang_id' => $this->lang_id,
            'birth_date' => $this->birth_date,
            'birth_place_id' => $this->birth_place_id,
            'birth_country_id' => $this->birth_country_id,
            'livestatus' => $this->livestatus,
            'nationality_id' => $this->nationality_id,
            'citizenship_id' => $this->citizenship_id,
            'sex' => $this->sex,
            'doc_give_place_id' => $this->doc_give_place_id,
            'date_begin_document' => $this->date_begin_document,
            'date_end_document' => $this->date_end_document,
            'who_registred' => $this->who_registred,
            'create_date' => $this->create_date,
            'citizen_status' => $this->citizen_status,
        ]);

        $query->andFilterWhere(['ilike', 'document', $this->document])
            ->andFilterWhere(['ilike', 'pinpp', $this->pinpp])
            ->andFilterWhere(['ilike', 'name_latin', $this->name_latin])
            ->andFilterWhere(['ilike', 'surname_latin', $this->surname_latin])
            ->andFilterWhere(['ilike', 'patronym_latin', $this->patronym_latin])
            ->andFilterWhere(['ilike', 'name_engl', $this->name_engl])
            ->andFilterWhere(['ilike', 'surname_engl', $this->surname_engl])
            ->andFilterWhere(['ilike', 'birth_place', $this->birth_place])
            ->andFilterWhere(['ilike', 'birth_country', $this->birth_country])
            ->andFilterWhere(['ilike', 'nationality', $this->nationality])
            ->andFilterWhere(['ilike', 'citizenship', $this->citizenship])
            ->andFilterWhere(['ilike', 'doc_give_place', $this->doc_give_place])
            ->andFilterWhere(['ilike', 'inn', $this->inn])
            ->andFilterWhere(['ilike', 'address', $this->address])
            ->andFilterWhere(['ilike', 'phone', $this->phone])
            ->andFilterWhere(['ilike', 'email', $this->email])
            ->andFilterWhere(['ilike', 'work_place', $this->work_place]);

        return $dataProvider;
    }
}

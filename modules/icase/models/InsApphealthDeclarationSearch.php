<?php

namespace app\modules\icase\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\icase\models\InsApphealthDeclaration;

/**
 * InsApphealthDeclarationSearch represents the model behind the search form of `app\modules\icase\models\InsApphealthDeclaration`.
 */
class InsApphealthDeclarationSearch extends InsApphealthDeclaration
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_appform', 'chronic_disease', 'disability', 'group_disability', 'doctor_observations', 'inpatient_treatment', 'count_inpatient_treatment', 'l5_operation', 'id_admin_users'], 'integer'],
            [['def_chronic_disease', 'couse_disability', 'old_disability', 'placename_treatment', 'diagnosis_inpatient_treatment', 'cause_l5_operation', 'placename_l5_operation', 'date_completion', 'create_date'], 'safe'],
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
        $query = InsApphealthDeclaration::find();

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
            'id_appform' => $this->id_appform,
            'chronic_disease' => $this->chronic_disease,
            'disability' => $this->disability,
            'group_disability' => $this->group_disability,
            'doctor_observations' => $this->doctor_observations,
            'inpatient_treatment' => $this->inpatient_treatment,
            'count_inpatient_treatment' => $this->count_inpatient_treatment,
            'l5_operation' => $this->l5_operation,
            'date_completion' => $this->date_completion,
            'create_date' => $this->create_date,
            'id_admin_users' => $this->id_admin_users,
        ]);

        $query->andFilterWhere(['ilike', 'def_chronic_disease', $this->def_chronic_disease])
            ->andFilterWhere(['ilike', 'couse_disability', $this->couse_disability])
            ->andFilterWhere(['ilike', 'old_disability', $this->old_disability])
            ->andFilterWhere(['ilike', 'placename_treatment', $this->placename_treatment])
            ->andFilterWhere(['ilike', 'diagnosis_inpatient_treatment', $this->diagnosis_inpatient_treatment])
            ->andFilterWhere(['ilike', 'cause_l5_operation', $this->cause_l5_operation])
            ->andFilterWhere(['ilike', 'placename_l5_operation', $this->placename_l5_operation]);

        return $dataProvider;
    }
}

<?php

namespace frontend\modules\sta\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\sta\models\Talleres;

/**
 * TalleresSearch represents the model behind the search form of `frontend\modules\sta\models\Talleres`.
 */
class TalleresdetSearch extends Talleres
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ciclo'], 'integer'],
            [['codfac', 'codcur', 'activa', 'codperiodo', 'electivo'], 'safe'],
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
        $query = Talleres::find();

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
            'ciclo' => $this->ciclo,
        ]);

        $query->andFilterWhere(['like', 'codfac', $this->codfac])
            ->andFilterWhere(['like', 'codcur', $this->codcur])
            ->andFilterWhere(['like', 'activa', $this->activa])
            ->andFilterWhere(['like', 'codperiodo', $this->codperiodo])
            ->andFilterWhere(['like', 'electivo', $this->electivo]);

        return $dataProvider;
    }
     public function searchById($params,$id)
    {
        $query = Talleres::find();

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
            'ciclo' => $this->ciclo,
        ]);

        $query->andFilterWhere(['like', 'codfac', $this->codfac])
            ->andWhere(['talleres_id'=>$id])
            ->andFilterWhere(['like', 'activa', $this->activa])
            ->andFilterWhere(['like', 'codperiodo', $this->codperiodo])
            ->andFilterWhere(['like', 'electivo', $this->electivo]);

        return $dataProvider;
    }
     
}

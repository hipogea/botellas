<?php

namespace common\models\masters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\masters\Trabajadores;

/**
 * TrabajadoresSearch represents the model behind the search form of `common\models\masters\Trabajadores`.
 */
class TrabajadoresSearch extends Trabajadores
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigotra', 'ap', 'am', 'nombres', 'dni', 'ppt', 'pasaporte', 'codpuesto', 'cumple', 'fecingreso', 'domicilio', 'telfijo', 'telmoviles', 'referencia'], 'safe'],
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
        $query = Trabajadores::find();

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
        $query->andFilterWhere(['like', 'codigotra', $this->codigotra])
            ->andFilterWhere(['like', 'ap', $this->ap])
            ->andFilterWhere(['like', 'am', $this->am])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'dni', $this->dni])
            ->andFilterWhere(['like', 'ppt', $this->ppt])
            ->andFilterWhere(['like', 'pasaporte', $this->pasaporte])
            ->andFilterWhere(['like', 'codpuesto', $this->codpuesto])
            ->andFilterWhere(['like', 'cumple', $this->cumple])
            ->andFilterWhere(['like', 'fecingreso', $this->fecingreso])
            ->andFilterWhere(['like', 'domicilio', $this->domicilio])
            ->andFilterWhere(['like', 'telfijo', $this->telfijo])
            ->andFilterWhere(['like', 'telmoviles', $this->telmoviles])
            ->andFilterWhere(['like', 'referencia', $this->referencia]);

        return $dataProvider;
    }
}

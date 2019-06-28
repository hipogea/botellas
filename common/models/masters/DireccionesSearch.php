<?php

namespace common\models\masters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\masters\Direcciones;

/**
 * DireccionesSearch represents the model behind the search form of `common\models\masters\Direcciones`.
 */
class DireccionesSearch extends Direcciones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['direc', 'nomlug', 'distrito', 'provincia', 'departamento', 'latitud', 'meridiano', 'codpro'], 'safe'],
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
        $query = Direcciones::find();

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
        ]);

        $query->andFilterWhere(['like', 'direc', $this->direc])
            ->andFilterWhere(['like', 'nomlug', $this->nomlug])
            ->andFilterWhere(['like', 'distrito', $this->distrito])
            ->andFilterWhere(['like', 'provincia', $this->provincia])
            ->andFilterWhere(['like', 'departamento', $this->departamento])
            ->andFilterWhere(['like', 'latitud', $this->latitud])
            ->andFilterWhere(['like', 'meridiano', $this->meridiano])
            ->andFilterWhere(['like', 'codpro', $this->codpro]);

        return $dataProvider;
    }
    
     public function searchByCodpro($codpro)
    {
        $query = Direcciones::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        

        // grid filtering conditions
        $query->andFilterWhere(['=', 'codpro', $codpro]);

        return $dataProvider;
    }
}

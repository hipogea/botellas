<?php

namespace frontend\modules\sigi\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\sigi\models\SigiUnidades;

/**
 * SigiUnidadesSearch represents the model behind the search form of `frontend\modules\sigi\models\SigiUnidades`.
 */
class SigiUnidadesSearch extends SigiUnidades
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'npiso', 'edificio_id', 'parent_id'], 'integer'],
            [['codtipo', 'numero', 'nombre', 'detalles', 'estreno'], 'safe'],
            [['area', 'participacion'], 'number'],
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
        $query = SigiUnidades::find();

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
            'npiso' => $this->npiso,
            'edificio_id' => $this->edificio_id,
            'area' => $this->area,
            'participacion' => $this->participacion,
            'parent_id' => $this->parent_id,
        ]);

        $query->andFilterWhere(['like', 'codtipo', $this->codtipo])
            ->andFilterWhere(['like', 'numero', $this->numero])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'detalles', $this->detalles])
            ->andFilterWhere(['like', 'estreno', $this->estreno]);

        return $dataProvider;
    }
      public function searchByEdificio($edificio_id)
    {
        $query = SigiUnidades::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->where([
            'edificio_id' => $edificio_id,
           // 'npisos' => $this->npisos,
        ]);
        // grid filtering conditions
        
        return $dataProvider;
    }
}

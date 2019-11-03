<?php

namespace frontend\modules\sigi\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\sigi\models\Edificios;

/**
 * EdificiosSearch represents the model behind the search form of `\frontend\modules\sigi\models\Edificios`.
 */
class EdificiosSearch extends Edificios
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'npisos'], 'integer'],
            [['codtra', 'nombre', 'latitud', 'meridiano', 'proyectista', 'tipo', 'detalles', 'codcen', 'direccion', 'coddepa', 'codprov'], 'safe'],
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
        $query = Edificios::find();

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
            'npisos' => $this->npisos,
        ]);

        $query->andFilterWhere(['like', 'codtra', $this->codtra])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'latitud', $this->latitud])
            ->andFilterWhere(['like', 'meridiano', $this->meridiano])
            ->andFilterWhere(['like', 'proyectista', $this->proyectista])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'detalles', $this->detalles])
            ->andFilterWhere(['like', 'codcen', $this->codcen])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'coddepa', $this->coddepa])
            ->andFilterWhere(['like', 'codprov', $this->codprov]);

        return $dataProvider;
    }
}

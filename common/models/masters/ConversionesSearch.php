<?php

namespace common\models\masters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\masters\Conversiones;

/**
 * CliproSearch represents the model behind the search form of `common\models\masters\Clipro`.
 */
class ConversionesSearch extends Conversiones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codum1', 'codum2', 'valor1', 'valor2'], 'safe'],
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
        $query = Conversiones::find();

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
        $query->andFilterWhere(['like','codum1',  $this->codum1])
            ->andFilterWhere(['like','codum2', $this->codum2])
            ->andFilterWhere(['like','valor1', $this->valor1])
            ->andFilterWhere(['like','valor2', $this->valor2]);
           

        return $dataProvider;
    }
    
    public function searchByMaterial($codart)
    {
        $query = Conversiones::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        

        // grid filtering conditions
        $query->andFilterWhere(['=', 'codart', $codart]);

        return $dataProvider;
    }
}

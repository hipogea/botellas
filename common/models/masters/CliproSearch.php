<?php

namespace common\models\masters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\masters\Clipro;

/**
 * CliproSearch represents the model behind the search form of `common\models\masters\Clipro`.
 */
class CliproSearch extends Clipro
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codpro', 'despro', 'rucpro', 'telpro', 'web', 'deslarga'], 'safe'],
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
        $query = Clipro::find();

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
        $query->andFilterWhere(['like', 'codpro', $this->codpro])
            ->andFilterWhere(['like', 'despro', $this->despro])
            ->andFilterWhere(['like', 'rucpro', $this->rucpro])
            ->andFilterWhere(['like', 'telpro', $this->telpro])
            ->andFilterWhere(['like', 'web', $this->web])
            ->andFilterWhere(['like', 'deslarga', $this->deslarga]);

        return $dataProvider;
    }
    
    public function searchByCodpro($codpro)
    {
        $query = Clipro::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        

        // grid filtering conditions
        $query->andFilterWhere(['=', 'codpro', $codpro]);

        return $dataProvider;
    }
}

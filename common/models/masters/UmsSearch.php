<?php

namespace common\models\masters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\masters\Ums;

/**
 * UmsSearch represents the model behind the search form of `common\models\masters\Ums`.
 */
class UmsSearch extends Ums
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codum', 'desum', 'dimension'], 'safe'],
            [['escala'], 'integer'],
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
        $query = Ums::find();

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
            'escala' => $this->escala,
        ]);

        $query->andFilterWhere(['like', 'codum', $this->codum])
            ->andFilterWhere(['like', 'desum', $this->desum])
            ->andFilterWhere(['like', 'dimension', $this->dimension]);

        return $dataProvider;
    }
}

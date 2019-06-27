<?php

namespace common\models\masters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\masters\Maestrocompo;

/**
 * CliproSearch represents the model behind the search form of `common\models\masters\Clipro`.
 */
class MaestrocompoSearch extends Maestrocompo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codart', 'descripcion', 'marca', 'modelo',  'numeroparte'], 'safe'],
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
        $query = Maestrocompo::find();

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
        $query->andFilterWhere(['like', 'codart', $this->codart])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'marca', $this->marca])
            ->andFilterWhere(['like', 'numeroparte', $this->numeroparte])     
            ->andFilterWhere(['like', 'modelo',$this->modelo]);
        
           

        return $dataProvider;
    }
    
   
}

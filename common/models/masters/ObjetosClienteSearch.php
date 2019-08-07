<?php

namespace common\models\masters;
use yii\base\Model;
use yii\data\ActiveDataProvider;
//use common\models\masters\Clipro;
class ObjetosClienteSearch extends Clipro
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codpro', 'descripcion'], 'safe'],
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
        $query = ObjetosCliente::find();

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
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
    
    public function searchByCodpro($codpro)
    {
        $query = ObjetosCliente::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        

        // grid filtering conditions
        $query->andFilterWhere(['=', 'codpro', $codpro]);

        return $dataProvider;
    }
}

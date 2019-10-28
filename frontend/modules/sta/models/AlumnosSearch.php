<?php

namespace frontend\modules\sta\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\sta\models\Alumnos;

/**
 * AlumnosController represents the model behind the search form of `frontend\modules\sta\models\Alumnos`.
 */
class AlumnosSearch extends Alumnos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'profile_id'], 'integer'],
            [['codcar', 'ap', 'am', 'nombres', 'fecna', 'codalu', 'dni', 'domicilio', 'codist', 'codprov', 'codep', 'sexo'], 'safe'],
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
        $query = Alumnos::find();

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
       /* $query->andFilterWhere([
            'id' => $this->id,
            'profile_id' => $this->profile_id,
        ]);*/

        $query->andFilterWhere(['like', 'codcar', $this->codcar])
            ->andFilterWhere(['like', 'ap', $this->ap])
            ->andFilterWhere(['like', 'am', $this->am])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'fecna', $this->fecna])
            ->andFilterWhere(['like', 'codalu', $this->codalu])
            ->andFilterWhere(['like', 'dni', $this->dni])
            ->andFilterWhere(['like', 'domicilio', $this->domicilio])
            ->andFilterWhere(['like', 'codist', $this->codist])
            ->andFilterWhere(['like', 'codprov', $this->codprov])
            ->andFilterWhere(['like', 'codep', $this->codep])
            ->andFilterWhere(['like', 'sexo', $this->sexo]);

        return $dataProvider;
    }
}

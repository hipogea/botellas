<?php

namespace frontend\modules\sta\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\sta\models\VwAluriesgo;

/**
 * FacultadesSearch represents the model behind the search form of `frontend\modules\sta\models\Facultades`.
 */
class VwAluriesgoSearch extends VwAluriesgo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           [['codcar','codfac','codcur', 'ap', 'am', 'nombres',  'codalu', 'dni', 'correo', 'fijos', 'celulares', 'fijos','nomcur'], 'safe'],
     
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
        $query = VwAluriesgo::find();

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
        $query->andFilterWhere(['like', 'codcar', $this->codcar])
            ->andFilterWhere(['like', 'ap', $this->ap])
                 ->andFilterWhere(['like', 'codcur', $this->codcur])
            ->andFilterWhere(['like', 'am', $this->am])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
           ->andFilterWhere(['like', 'correo', $this->correo])
            ->andFilterWhere(['like', 'codalu', $this->codalu])
            ->andFilterWhere(['like', 'dni', $this->dni])
            //->andFilterWhere(['like', 'domicilio', $this->domicilio])
            ->andFilterWhere(['like', 'celulares', $this->celulares])
            ->andFilterWhere(['like', 'nomcur', $this->nomcur])
          ->andFilterWhere(['like', 'codfac', $this->codfac])
            ->andFilterWhere(['like', 'codperiodo', $this->codperiodo]);

        return $dataProvider;
    }
    
     public function searchByFacultad($params,$codfac)
    {
        $query = VwAluriesgo::find();

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
        $query->andFilterWhere(['like', 'codcar', $this->codcar])
            ->andFilterWhere(['like', 'ap', $this->ap])
                ->andWhere(['codfac'=>$codfac])
                 ->andFilterWhere(['like', 'codcur', $this->codcur])
            ->andFilterWhere(['like', 'am', $this->am])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
           ->andFilterWhere(['like', 'correo', $this->correo])
            ->andFilterWhere(['like', 'codalu', $this->codalu])
            ->andFilterWhere(['like', 'dni', $this->dni])
            //->andFilterWhere(['like', 'domicilio', $this->domicilio])
            ->andFilterWhere(['like', 'celulares', $this->celulares])
            ->andFilterWhere(['like', 'nomcur', $this->nomcur])
          ->andFilterWhere(['like', 'codfac', $this->codfac])
            ->andFilterWhere(['like', 'codperiodo', $this->codperiodo]);

        return $dataProvider;
    }
    
}

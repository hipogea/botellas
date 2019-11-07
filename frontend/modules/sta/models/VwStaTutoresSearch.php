<?php

namespace frontend\modules\sta\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\sta\models\VwStaTutores;

/**
 * FacultadesSearch represents the model behind the search form of `frontend\modules\sta\models\Facultades`.
 */
class VwStaTutoresSearch extends VwStaTutores
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           [['codfac','codtra', 'ap', 'am', 'nombres',  'descripcion', 'numero', 'calificacion', 'nalumnos', 'codocu', 'codperiodo'], 'safe'],
     
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
        $query = VwStaTutores::find();

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

         $query->andFilterWhere(['like', 'ap', $this->ap])
                 ->andFilterWhere(['like', 'am', $this->am])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
           // ->andWhere(['codfac'=>$this->codfac])
          // ->andWhere(['codtra'=>$this->codtra])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'numero', $this->numero])
            ->andFilterWhere(['like', 'nalumnos', $this->nalumnos])
                // ->andWhere(['calificacion'=>$this->calificacion])
            //->andFilterWhere(['like', 'nomcur', $this->nomcur])
          ->andFilterWhere(['like', 'codperiodo', $this->codperiodo]);
       // ->andWhere(['codocu'=>$this->codocu]);
        return $dataProvider;
    }
    
     public function searchByFacultad($params,$codfac)
    {
        $query = VwAlutaller::find();

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
        $query->andFilterWhere(['like', 'ap', $this->ap])
                 ->andFilterWhere(['like', 'am', $this->am])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andWhere(['codfac'=>$this->codfac])
           ->andWhere(['codtra'=>$this->codtra])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'numero', $this->numero])
            ->andFilterWhere(['like', 'nalumnos', $this->nalumnos])
                 ->andWhere(['calificacion'=>$this->calificacion])
            //->andFilterWhere(['like', 'nomcur', $this->nomcur])
          ->andFilterWhere(['like', 'codperiodo', $this->codperiodo])
        ->andWhere(['codocu'=> $this->codocu]);
           
            //->andFilterWhere(['like', 'nomcur', $this->nomcur])
        //  ->andFilterWhere(['like', 'codfac', $this->codfac])
           // ->andFilterWhere(['like', 'codperiodo', $this->codperiodo]);
        return $dataProvider;
    }
    
}

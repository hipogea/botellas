<?php

namespace frontend\modules\bigitems\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\bigitems\models\Docbotellas;
use common\models\masters\Clipro;
/**
 * DocbotellasSearch represents the model behind the search form of `frontend\modules\bigitems\models\Docbotellas`.
 */
class DocbotellasSearch extends Docbotellas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ptopartida_id', 'ptollegada_id'], 'integer'],
            [['codestado', 'codpro','fectran1', 'numero', 'codcen', 'descripcion', 'codenvio', 'fecdocu', 'fectran', 'codtra', 'codven', 'codplaca', 'comentario', 'essalida'], 'safe'],
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
        $query = Docbotellas::find();
  /*$query = Docbotellas::find()->
                innerJoin(Clipro::tableName(),
                        Clipro::tableName().'.codpro='.$this->tableName().'.codpro'
                        );
  */
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
//var_dump($dataProvider->models);die();
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ptopartida_id' => $this->ptopartida_id,
            'ptollegada_id' => $this->ptollegada_id,
        ]);

        if(!empty($this->fectran) && !empty($this->fectran1)){
         $query->andFilterWhere([
             'between',
             'fectran',
             $this->openBorder('fectran',false),
             $this->openBorder('fectran1',true)
                        ]);   
        }
        
        
        $query->/*andFilterWhere(['between', 'fectran', $this->setFormatTimeFromSettings('fectran',false),$this->setFormatTimeFromSettings('fectran1',false)])
            ->*/andFilterWhere(['like', 'codpro', $this->codpro])
            ->andFilterWhere(['like', 'numero', $this->numero])
            ->andFilterWhere(['like', 'codcen', $this->codcen])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'codenvio', $this->codenvio])
            ->andFilterWhere(['like', 'fecdocu', $this->fecdocu])
            ->andFilterWhere(['like', 'fectran', $this->fectran])
            ->andFilterWhere(['like', 'codtra', $this->codtra])
            ->andFilterWhere(['like', 'codven', $this->codven])
            ->andFilterWhere(['like', 'codplaca', $this->codplaca])
            ->andFilterWhere(['like', 'comentario', $this->comentario]);

        return $dataProvider;
    }
}

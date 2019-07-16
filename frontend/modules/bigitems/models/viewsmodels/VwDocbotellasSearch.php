<?php
namespace frontend\modules\bigitems\models\viewsmodels;
use frontend\modules\bigitems\models\viewsmodels\VwDocbotellas;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\masters\Clipro;
/**
 * DocbotellasSearch represents the model behind the search form of `frontend\modules\bigitems\models\Docbotellas`.
 */
class VwDocbotellasSearch extends VwDocbotellas
{
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['codestado', 
                'codpro',
                'fectran1',
                'numero', 
                'codcen', 
                'descripcion',
                'codenvio', 
                'fecdocu', 
                'fectran', 
                'codtra',
                'codven', 
                'codplaca',
                'comentario',
                'essalida',
                'despro',
                'direcpartida',
                'direcllegada',
                'apvendedor',
                'nombrevendedor',
                'aptrans',
                'nombretrans',
                'rucpro',
                'codestado','codigo'
                ], 
                
                'safe'],
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

     public function getClipro()
    {
        return $this->hasOne(Clipro::className(), ['codpro' => 'codpro']);
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
       //var_dump($this->fieldsLink(false)); die();
        
        
        $query = VwDocbotellas::find();
  /*$query = Docbotellas::find()->
                innerJoin(Clipro::tableName(),
                        Clipro::tableName().'.codpro='.$this->tableName().'.codpro'
                        );
  */
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        //var_dump($params);die();
        if(!empty($params))
     $query= $this->addCriteria($query,$params);
//var_dump($dataProvider->models);die();
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        

        if(!empty($this->fectran) && !empty($this->fectran1)){
         $query->andFilterWhere([
             'between',
             'fectran',
             $this->openBorder('fectran',false),
             $this->openBorder('fectran1',true)
                        ]);   
        }
        
         if(!empty($this->fectran) && !empty($this->fectran1)){
         $query->andFilterWhere([
             'between',
             'fecdocu',
             $this->openBorder('fecdocu',false),
             $this->openBorder('fecdocu1',true)
                        ]);   
        }
        
        
       
        
        
        
        $query->andFilterWhere(['like', 'despro', $this->despro])
          ->andFilterWhere(['like', 'direcpartida', $this->direcpartida])
                 ->andFilterWhere(['like', 'codestado', $this->codestado])
                 ->andFilterWhere(['like', 'codigo', $this->codigo])
           ->andFilterWhere(['like', 'direcllegada', $this->direcpartida])
->andFilterWhere(['like', 'desactivo', $this->desactivo])                        
          ->andFilterWhere(['like', 'apvendedor', $this->apvendedor])
          ->andFilterWhere(['like', 'nombrevendedor', $this->nombrevendedor])
           ->andFilterWhere(['like', 'aptrans', $this->aptrans])
->andFilterWhere(['like', 'nombretrans', $this->nombretrans])
          //   ->andFilterWhere(['like', 'codpro', $this->codpro])
            ->andFilterWhere(['like', 'codcen', $this->codcen])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'codenvio', $this->codenvio])
            ->andFilterWhere(['like', 'fecdocu', $this->fecdocu])
            ->andFilterWhere(['like', 'fectran', $this->fectran])
            ->andFilterWhere(['like', 'codtra', $this->codtra])
            ->andFilterWhere(['like', 'codven', $this->codven])
             ->andFilterWhere(['like', 'rucpro', $this->rucpro])
            ->andFilterWhere(['like', 'codplaca', $this->codplaca])
            ->andFilterWhere(['like', 'essalida', $this->essalida]);

        return $dataProvider;
    }
    
    public function searchByDoc($id,$pageSize){
         $query = VwDocbotellas::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize,
            ],
        ]);
    $query->where(['=', 'id', $id]);
       return $dataProvider;

    }
    
    private function addCriteria(&$query,$params){
        $campos=array_keys($this->fieldsLink(false));
        $nombreclase=$this->getShortNameClass();
        
        foreach($campos as $clave=>$nombrecampo){
            $valorcampo=$params[$nombreclase][$nombrecampo];
             if(is_array($valorcampo)){            
           if(count($valorcampo)>0){               
               $query->andFilterWhere([$nombrecampo=>$valorcampo]);
                $params[$nombreclase][$nombrecampo]=$params[$nombreclase][$nombrecampo][0];
           } else{
               $params[$nombreclase][$nombrecampo]=''; 
           }
        } else{
           $query->andFilterWhere(['like', $nombrecampo, $this->{$nombrecampo}]);
        }
        }
        return $query;
        
    }
}

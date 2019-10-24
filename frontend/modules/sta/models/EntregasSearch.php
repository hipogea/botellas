<?php

namespace frontend\modules\sta\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\sta\models\Entregas;

/**
 * EntregasSearch represents the model behind the search form of `frontend\modules\sta\models\Entregas`.
 */
class EntregasSearch extends Entregas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['codfac', 'fecha', 'fechacorte', 'version', 'codperiodo', 'descripcion'], 'safe'],
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
        $query = Entregas::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

      /*  if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }*/

       

        $query->andFilterWhere(['like', 'codfac', $this->codfac])
            ->andFilterWhere(['like', 'fecha', $this->fecha])
            ->andFilterWhere(['like', 'fechacorte', $this->fechacorte])
            ->andFilterWhere(['like', 'version', $this->version])
            ->andFilterWhere(['like', 'codperiodo', $this->codperiodo]);
            //->andFilterWhere(['like', 'codalu', $this->codalu]);  
        return $dataProvider;
    }
}

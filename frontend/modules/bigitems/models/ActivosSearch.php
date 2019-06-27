<?php

namespace frontend\modules\bigitems\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\bigitems\models\Activos;

/**
 * ActivosSearch represents the model behind the search form of `frontend\modules\bigitems\models\Activos`.
 */
class ActivosSearch extends Activos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'lugar_original_id', 'lugar_id'], 'integer'],
            [['codigo', 'codigo2', 'codigo3', 'descripcion', 'marca', 'modelo', 'serie', 'anofabricacion', 'codigoitem', 'codigocontable', 'espadre', 'tipo', 'codarea', 'codestado', 'fecha', 'codocu', 'numdoc', 'entransporte'], 'safe'],
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
        $query = Activos::find();

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
            'id' => $this->id,
            'lugar_original_id' => $this->lugar_original_id,
            'lugar_id' => $this->lugar_id,
        ]);

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'codigo2', $this->codigo2])
            ->andFilterWhere(['like', 'codigo3', $this->codigo3])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'marca', $this->marca])
            ->andFilterWhere(['like', 'modelo', $this->modelo])
            ->andFilterWhere(['like', 'serie', $this->serie])
            ->andFilterWhere(['like', 'anofabricacion', $this->anofabricacion])
            ->andFilterWhere(['like', 'codigoitem', $this->codigoitem])
            ->andFilterWhere(['like', 'codigocontable', $this->codigocontable])
            ->andFilterWhere(['like', 'espadre', $this->espadre])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'codarea', $this->codarea])
            ->andFilterWhere(['like', 'codestado', $this->codestado])
            ->andFilterWhere(['like', 'fecha', $this->fecha])
            ->andFilterWhere(['like', 'codocu', $this->codocu])
            ->andFilterWhere(['like', 'numdoc', $this->numdoc])
            ->andFilterWhere(['like', 'entransporte', $this->entransporte]);

        return $dataProvider;
    }
}

<?php

namespace frontend\modules\sigi\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\sigi\models\SigiBasePresupuesto;

/**
 * SigiBasePresupuestoSearch represents the model behind the search form of `frontend\modules\sigi\models\SigiBasePresupuesto`.
 */
class SigiBasePresupuestoSearch extends SigiBasePresupuesto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'edificio_id'], 'integer'],
            [['codgrupo', 'codigo', 'descripcion', 'activo', 'ejercicio', 'restringir'], 'safe'],
            [['mensual', 'anual', 'acumulado'], 'number'],
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
        $query = SigiBasePresupuesto::find();

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
            'edificio_id' => $this->edificio_id,
            'mensual' => $this->mensual,
            'anual' => $this->anual,
            'acumulado' => $this->acumulado,
        ]);

        $query->andFilterWhere(['like', 'codgrupo', $this->codgrupo])
            ->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'activo', $this->activo])
            ->andFilterWhere(['like', 'ejercicio', $this->ejercicio])
            ->andFilterWhere(['like', 'restringir', $this->restringir]);

        return $dataProvider;
    }
}

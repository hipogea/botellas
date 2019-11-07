<?php

namespace frontend\modules\sigi\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\sigi\models\SigiApoderados;

/**
 * SigiBasePresupuestoSearch represents the model behind the search form of `frontend\modules\sigi\models\SigiBasePresupuesto`.
 */
class SigiApoderadosSearch extends SigiApoderados
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
    public function searchByEdificio($edificio_id)
    {
        $query = SigiApoderados::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->where([
            'edificio_id' => $edificio_id,
           // 'npisos' => $this->npisos,
        ]);
        // grid filtering conditions
        
        return $dataProvider;
    }
}

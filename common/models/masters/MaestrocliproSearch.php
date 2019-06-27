<?php

namespace common\models\masters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\masters\Maestroclipro;

/**
 * MaestrocliproSearch represents the model behind the search form of `common\models\masters\Maestroclipro`.
 */
class MaestrocliproSearch extends Maestroclipro
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'vencimiento', 'tiempoentrega'], 'integer'],
            [['venta', 'codpro', 'codart', 'codcen', 'codmon', 'param1', 'param2', 'param3', 'param4'], 'safe'],
            [['precio'], 'number'],
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
        $query = Maestroclipro::find();

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
            'vencimiento' => $this->vencimiento,
            'tiempoentrega' => $this->tiempoentrega,
            'precio' => $this->precio,
        ]);

        $query->andFilterWhere(['like', 'venta', $this->venta])
            ->andFilterWhere(['like', 'codpro', $this->codpro])
            ->andFilterWhere(['like', 'codart', $this->codart])
            ->andFilterWhere(['like', 'codcen', $this->codcen])
            ->andFilterWhere(['like', 'codmon', $this->codmon])
            ->andFilterWhere(['like', 'param1', $this->param1])
            ->andFilterWhere(['like', 'param2', $this->param2])
            ->andFilterWhere(['like', 'param3', $this->param3])
            ->andFilterWhere(['like', 'param4', $this->param4]);

        return $dataProvider;
    }
    
    
    public function searchByCodpro($codpro)
    {
        $query = Maestroclipro::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        

        // grid filtering conditions
        $query->andFilterWhere(['=', 'codpro', $codpro]);

        return $dataProvider;
    }
}

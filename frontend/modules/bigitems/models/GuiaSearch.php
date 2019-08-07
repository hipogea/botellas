<?php

namespace frontend\modules\bigitems\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\bigitems\models\Guia;

/**
 * GuiaSearch represents the model behind the search form of `frontend\modules\bigitems\models\Guia`.
 */
class GuiaSearch extends Guia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ptopartida_id', 'ptollegada_id'], 'integer'],
            [['numgui', 'descripcion', 'serie', 'codpro', 'codpro_tran', 'fecha', 'fecha_tran', 'codestado', 'chofer', 'codmotivo', 'placa', 'confvehicular', 'brevete', 'codcen', 'codocu', 'comentario', 'essalida'], 'safe'],
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
        $query = Guia::find();

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
            'ptopartida_id' => $this->ptopartida_id,
            'ptollegada_id' => $this->ptollegada_id,
        ]);

        $query->andFilterWhere(['like', 'numgui', $this->numgui])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'serie', $this->serie])
            ->andFilterWhere(['like', 'codpro', $this->codpro])
            ->andFilterWhere(['like', 'codpro_tran', $this->codpro_tran])
            ->andFilterWhere(['like', 'fecha', $this->fecha])
            ->andFilterWhere(['like', 'fecha_tran', $this->fecha_tran])
            ->andFilterWhere(['like', 'codestado', $this->codestado])
            ->andFilterWhere(['like', 'chofer', $this->chofer])
            ->andFilterWhere(['like', 'codmotivo', $this->codmotivo])
            ->andFilterWhere(['like', 'placa', $this->placa])
            ->andFilterWhere(['like', 'confvehicular', $this->confvehicular])
            ->andFilterWhere(['like', 'brevete', $this->brevete])
            ->andFilterWhere(['like', 'codcen', $this->codcen])
            ->andFilterWhere(['like', 'codocu', $this->codocu])
            ->andFilterWhere(['like', 'comentario', $this->comentario])
            ->andFilterWhere(['like', 'essalida', $this->essalida]);

        return $dataProvider;
    }
}

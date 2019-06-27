<?php

namespace common\models\config;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\config\Configuracion;

/**
 * ConfiguracionSearch represents the model behind the search form of `common\models\config\Configuracion`.
 */
class ConfiguracionSearch extends Configuracion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['codcen', 'codocu', 'codparam', 'valor'], 'safe'],
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
        $query = Configuracion::find();

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
        ]);

        $query->andFilterWhere(['like', 'codcen', $this->codcen])
            ->andFilterWhere(['like', 'codocu', $this->codocu])
            ->andFilterWhere(['like', 'codparam', $this->codparam])
            ->andFilterWhere(['like', 'valor', $this->valor]);

        return $dataProvider;
    }
}

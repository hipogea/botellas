<?php

namespace common\models\masters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\masters\Sociedades;

/**
 * SociedadesSearch represents the model behind the search form of `common\models\masters\Sociedades`.
 */
class SociedadesSearch extends Sociedades
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['socio', 'dsocio', 'rucsoc', 'activo', 'direccionfiscal', 'telefonos', 'web', 'mail', 'regimentributario'], 'safe'],
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
        $query = Sociedades::find();

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
        $query->andFilterWhere(['like', 'socio', $this->socio])
            ->andFilterWhere(['like', 'dsocio', $this->dsocio])
            ->andFilterWhere(['like', 'rucsoc', $this->rucsoc])
            ->andFilterWhere(['like', 'activo', $this->activo])
            ->andFilterWhere(['like', 'direccionfiscal', $this->direccionfiscal])
            ->andFilterWhere(['like', 'telefonos', $this->telefonos])
            ->andFilterWhere(['like', 'web', $this->web])
            ->andFilterWhere(['like', 'mail', $this->mail])
            ->andFilterWhere(['like', 'regimentributario', $this->regimentributario]);

        return $dataProvider;
    }
}

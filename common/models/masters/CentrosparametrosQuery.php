<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[Centrosparametros]].
 *
 * @see Centrosparametros
 */
class CentrosparametrosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Centrosparametros[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Centrosparametros|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

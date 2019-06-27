<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[Conversiones]].
 *
 * @see Conversiones
 */
class ConversionesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Conversiones[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Conversiones|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

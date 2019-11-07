<?php

namespace frontend\modules\sta\models;

/**
 * This is the ActiveQuery class for [[Rangos]].
 *
 * @see Rangos
 */
class RangosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Rangos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Rangos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

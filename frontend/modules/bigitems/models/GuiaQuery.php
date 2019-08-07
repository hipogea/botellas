<?php

namespace frontend\modules\bigitems\models;

/**
 * This is the ActiveQuery class for [[Guia]].
 *
 * @see Guia
 */
class GuiaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Guia[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Guia|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

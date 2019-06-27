<?php

namespace frontend\modules\bigitems\models;

/**
 * This is the ActiveQuery class for [[Activos]].
 *
 * @see Activos
 */
class ActivosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Activos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Activos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

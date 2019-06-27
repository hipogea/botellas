<?php

namespace frontend\modules\bigitems\models;

/**
 * This is the ActiveQuery class for [[Lugares]].
 *
 * @see Lugares
 */
class LugaresQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Lugares[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Lugares|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

<?php

namespace frontend\modules\sta\models;
use frontend\modules\sta\components\ActiveQueryScope;
/**
 * This is the ActiveQuery class for [[Entregas]].
 *
 * @see Entregas
 */
class EntregasQuery extends ActiveQueryScope
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Entregas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Entregas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

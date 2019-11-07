<?php

namespace frontend\modules\sta\models;

/**
 * This is the ActiveQuery class for [[Examenes]].
 *
 * @see Examenes
 */
class ExamenesQuery extends \frontend\modules\sta\components\ActiveQueryScope
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Examenes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Examenes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

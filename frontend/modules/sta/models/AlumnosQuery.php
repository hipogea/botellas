<?php

namespace frontend\modules\sta\models;
use frontend\modules\sta\components\ActiveQueryScope;

/**
 * This is the ActiveQuery class for [[Alumnos]].
 *
 * @see Alumnos
 */
class AlumnosQuery extends ActiveQueryScope
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Alumnos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Alumnos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

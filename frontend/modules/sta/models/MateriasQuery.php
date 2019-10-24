<?php

namespace frontend\modules\sta\models;

/**
 * This is the ActiveQuery class for [[Materias]].
 *
 * @see Materias
 */
class MateriasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Materias[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Materias|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

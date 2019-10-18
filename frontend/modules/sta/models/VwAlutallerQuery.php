<?php

namespace frontend\modules\sta\models;

/**
 * This is the ActiveQuery class for [[VwAlutaller]].
 *
 * @see VwAlutaller
 */
class VwAlutallerQuery extends \frontend\modules\sta\components\ActiveQueryScope
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return VwAlutaller[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return VwAlutaller|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

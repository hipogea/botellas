<?php

namespace frontend\modules\sta\models;

/**
 * This is the ActiveQuery class for [[Aulas]].
 *
 * @see Aulas
 */
class AulasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Aulas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Aulas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

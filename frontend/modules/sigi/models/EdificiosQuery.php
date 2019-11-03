<?php

namespace frontend\modules\sigi\models;

/**
 * This is the ActiveQuery class for [[Edificios]].
 *
 * @see Edificios
 */
class EdificiosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Edificios[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Edificios|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

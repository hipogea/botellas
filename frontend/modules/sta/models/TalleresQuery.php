<?php

namespace frontend\modules\sta\models;

/**
 * This is the ActiveQuery class for [[Talleres]].
 *
 * @see Talleres
 */
class TalleresQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Talleres[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Talleres|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

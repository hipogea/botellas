<?php

namespace frontend\modules\sta\models;

/**
 * This is the ActiveQuery class for [[Talleresdet]].
 *
 * @see Talleresdet
 */
class TalleresdetQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Talleresdet[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Talleresdet|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

<?php

namespace common\models\config;

/**
 * This is the ActiveQuery class for [[Parametroscentrosdocu]].
 *
 * @see Parametroscentrosdocu
 */
class ParametroscentrosdocuQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Parametroscentrosdocu[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Parametroscentrosdocu|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

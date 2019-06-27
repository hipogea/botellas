<?php

namespace frontend\modules\bigitems\models;

/**
 * This is the ActiveQuery class for [[LogTransporte]].
 *
 * @see LogTransporte
 */
class LogTransporteQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LogTransporte[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LogTransporte|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

<?php

namespace frontend\modules\sigi\models;

/**
 * This is the ActiveQuery class for [[SigiSuministros]].
 *
 * @see SigiSuministros
 */
class SigiSuministrosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SigiSuministros[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SigiSuministros|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

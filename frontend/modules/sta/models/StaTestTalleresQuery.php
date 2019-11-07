<?php

namespace frontend\modules\sta\models;

/**
 * This is the ActiveQuery class for [[StaTestTalleres]].
 *
 * @see StaTestTalleres
 */
class StaTestTalleresQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StaTestTalleres[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StaTestTalleres|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

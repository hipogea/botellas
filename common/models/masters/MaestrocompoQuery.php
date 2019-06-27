<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[Maestrocompo]].
 *
 * @see Maestrocompo
 */
class MaestrocompoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Maestrocompo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Maestrocompo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

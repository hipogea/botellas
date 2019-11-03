<?php

namespace frontend\modules\sigi\models;

/**
 * This is the ActiveQuery class for [[SigiTipoUnidades]].
 *
 * @see SigiTipoUnidades
 */
class SigiTipoUnidadesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SigiTipoUnidades[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SigiTipoUnidades|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

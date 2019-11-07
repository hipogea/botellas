<?php

namespace frontend\modules\sigi\models;

/**
 * This is the ActiveQuery class for [[SigiPropietarios]].
 *
 * @see SigiPropietarios
 */
class SigiPropietariosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SigiPropietarios[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SigiPropietarios|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

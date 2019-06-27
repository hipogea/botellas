<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[Contactos]].
 *
 * @see Contactos
 */
class ContactosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Contactos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Contactos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

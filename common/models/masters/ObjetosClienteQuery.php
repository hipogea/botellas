<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[ObjetosCliente]].
 *
 * @see ObjetosCliente
 */
class ObjetosClienteQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ObjetosCliente[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ObjetosCliente|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

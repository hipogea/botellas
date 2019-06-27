<?php

namespace frontend\modules\bigitems\models;

/**
 * This is the ActiveQuery class for [[Documentos]].
 *
 * @see Documentos
 */
class DocumentosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Documentos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Documentos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

<?php

namespace frontend\modules\bigitems\models;

/**
 * This is the ActiveQuery class for [[Detdocbotellas]].
 *
 * @see Detdocbotellas
 */
class DetdocbotellasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Detdocbotellas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Detdocbotellas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

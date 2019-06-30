<?php

namespace frontend\modules\bigitems\models;

/**
 * This is the ActiveQuery class for [[Docbotellas]].
 *
 * @see Docbotellas
 */
class DocbotellasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Docbotellas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Docbotellas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

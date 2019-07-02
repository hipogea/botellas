<?php

namespace frontend\modules\bigitems\models\viewsmodels;

/**
 * This is the ActiveQuery class for [[VwDocbotellas]].
 *
 * @see VwDocbotellas
 */
class VwDocbotellasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return VwDocbotellas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return VwDocbotellas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

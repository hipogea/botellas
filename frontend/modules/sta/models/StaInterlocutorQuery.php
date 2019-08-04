<?php

namespace frontend\modules\sta\models;

/**
 * This is the ActiveQuery class for [[StaInterlocutor]].
 *
 * @see StaInterlocutor
 */
class StaInterlocutorQuery extends \yii\db\ActiveQuery /* \frontend\modules\sta\components\ActiveQueryScope*/
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StaInterlocutor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StaInterlocutor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

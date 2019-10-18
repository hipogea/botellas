<?php

namespace frontend\modules\sta\models;
use frontend\modules\sta\components\ActiveQueryScope;
 
class UserFacultadesQuery extends ActiveQueryScope/*\yii\db\ActiveQuery*/
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserFacultades[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserFacultades|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

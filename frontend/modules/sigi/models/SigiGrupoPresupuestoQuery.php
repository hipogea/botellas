<?php

namespace frontend\modules\sigi\models;

/**
 * This is the ActiveQuery class for [[SigiGrupoPresupuesto]].
 *
 * @see SigiGrupoPresupuesto
 */
class SigiGrupoPresupuestoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SigiGrupoPresupuesto[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SigiGrupoPresupuesto|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

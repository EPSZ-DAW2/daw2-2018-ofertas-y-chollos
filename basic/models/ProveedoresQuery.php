<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Proveedor]].
 *
 * @see Proveedor
 */
class ProveedoresQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Proveedor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Proveedor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

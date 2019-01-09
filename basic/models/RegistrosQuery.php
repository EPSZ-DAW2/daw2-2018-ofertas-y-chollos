<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Registro]].
 *
 * @see Registro
 */
class RegistrosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Registro[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Registro|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

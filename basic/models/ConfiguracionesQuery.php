<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Configuracion]].
 *
 * @see Configuracion
 */
class ConfiguracionesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Configuracion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Configuracion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

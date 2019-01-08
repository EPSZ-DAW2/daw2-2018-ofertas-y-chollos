<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UsuariosAviso]].
 *
 * @see UsuariosAviso
 */
class UsuariosAvisosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return UsuariosAviso[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UsuariosAviso|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

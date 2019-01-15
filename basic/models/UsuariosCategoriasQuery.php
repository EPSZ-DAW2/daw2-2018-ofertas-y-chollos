<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UsuariosCategorias]].
 *
 * @see UsuariosCategorias
 */
class UsuariosCategoriasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UsuariosCategorias[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UsuariosCategorias|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

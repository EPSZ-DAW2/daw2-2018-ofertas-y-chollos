<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UsuariosAnuncios]].
 *
 * @see UsuariosAnuncios
 */
class UsuariosAnunciosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UsuariosAnuncios[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UsuariosAnuncios|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UsuariosEtiquetas]].
 *
 * @see UsuariosEtiquetas
 */
class UsuariosEtiquetasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UsuariosEtiquetas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UsuariosEtiquetas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

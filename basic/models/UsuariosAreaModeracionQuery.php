<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UsuariosAreaModeracion]].
 *
 * @see UsuariosAreaModeracion
 */
class UsuariosAreaModeracionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return UsuariosAreaModeracion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UsuariosAreaModeracion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

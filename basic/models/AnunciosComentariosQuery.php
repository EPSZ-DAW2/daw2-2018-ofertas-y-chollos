<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AnuncioComentario]].
 *
 * @see AnuncioComentario
 */
class AnunciosComentariosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return AnuncioComentario[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AnuncioComentario|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Categoria]].
 *
 * @see Categoria
 */
class CategoriasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Categoria[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Categoria|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

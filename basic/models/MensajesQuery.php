<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Mensaje]].
 *
 * @see Mensaje
 */
class MensajesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Mensaje[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Mensaje|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

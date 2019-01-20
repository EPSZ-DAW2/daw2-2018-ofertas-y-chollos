<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Anuncio_Comentario]].
 *
 * @see Anuncio_Comentario
 */
class Anuncios_ComentariosQuery extends \yii\db\ActiveQuery
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
	
	public function hijos($comentario_id, $anuncio_id)
    {
        return $this
			->andWhere(['comentario_id' => $comentario_id, 'anuncio_id' => $anuncio_id]);
    }
}

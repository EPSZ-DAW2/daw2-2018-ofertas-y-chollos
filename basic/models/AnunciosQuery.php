<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Anuncio]].
 *
 * @see Anuncio
 */
class AnunciosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/
	
	public function proximos($db = null)
    {
        return $this
			->andWhere(['visible' => 1, 'bloqueada' => 0])
			->andWhere(['<','fecha_desde', date('Y-m-d H:i:s')])
			->orderBy(['fecha_desde'=>SORT_DESC]);
    }
	
	public function populares($db = null)
    {
        return $this
			->andWhere(['visible' => 1, 'bloqueada' => 0])
			->orderBy(['votosOK'=>SORT_DESC]);
    }
	
	public function nuevos($db = null)
    {
        return $this
			->andWhere(['visible' => 1, 'bloqueada' => 0])
			->orderBy(['prioridad'=>SORT_DESC, 'id'=>SORT_DESC]);
    }
	
	public function zonas($id_zona)
    {
        return $this
			->andWhere(['visible' => 1, 'bloqueada' => 0, 'zona_id' => $id_zona])
			->orderBy(['prioridad'=>SORT_DESC, 'id'=>SORT_DESC]);
    }
	
	public function categorias($id_categoria)
    {
        return $this
			->andWhere(['visible' => 1, 'bloqueada' => 0, 'categoria_id' => $id_categoria])
			->orderBy(['prioridad'=>SORT_DESC, 'id'=>SORT_DESC]);
    }
	public function etiquetas($id_etiqueta)
    {
		
		$listaRelaciones= AnunciosEtiquetas::find()->select('anuncio_id')->where(['etiqueta_id' => $id_etiqueta])->all();
		$listaIds=array();
		foreach( $listaRelaciones as $anunciosEtiquetas){
			array_push($listaIds,$anunciosEtiquetas->anuncio_id);
		}
		
        return $this
			->andWhere(['visible' => 1, 'bloqueada' => 0])
			->andWhere(['in', 'id', $listaIds])
			->orderBy(['prioridad'=>SORT_DESC, 'id'=>SORT_DESC]);
    }
	public function busqueda($texto)
    {
        return $this
			->andWhere(['visible' => 1, 'bloqueada' => 0])
			->andWhere(['like', 'titulo', $texto])
			->orderBy(['prioridad'=>SORT_DESC, 'id'=>SORT_DESC]);
    }

    /**
     * @inheritdoc
     * @return Anuncio[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Anuncio|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

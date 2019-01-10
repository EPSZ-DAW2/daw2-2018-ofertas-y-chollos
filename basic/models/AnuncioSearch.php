<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Anuncio;

/**
 * AnuncioSearch represents the model behind the search form of `app\models\Anuncio`.
 */
class AnuncioSearch extends Anuncio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'zona_id', 'categoria_id', 'votosOK', 'votosKO', 'proveedor_id', 'prioridad', 'num_denuncias', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
            [['titulo', 'descripcion', 'tienda', 'url', 'fecha_desde', 'fecha_hasta', 'imagen_id', 'visible', 'terminada', 'fecha_terminacion', 'fecha_denuncia1', 'bloqueada', 'fecha_bloqueo', 'notas_bloqueo', 'cerrada_comentar', 'crea_fecha', 'modi_fecha', 'notas_admin'], 'safe'],
            [['precio_oferta', 'precio_original'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Anuncio::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'fecha_desde' => $this->fecha_desde,
            'fecha_hasta' => $this->fecha_hasta,
            'precio_oferta' => $this->precio_oferta,
            'precio_original' => $this->precio_original,
            'zona_id' => $this->zona_id,
            'categoria_id' => $this->categoria_id,
            'votosOK' => $this->votosOK,
            'votosKO' => $this->votosKO,
            'proveedor_id' => $this->proveedor_id,
            'prioridad' => $this->prioridad,
            'fecha_terminacion' => $this->fecha_terminacion,
            'num_denuncias' => $this->num_denuncias,
            'fecha_denuncia1' => $this->fecha_denuncia1,
            'fecha_bloqueo' => $this->fecha_bloqueo,
            'crea_usuario_id' => $this->crea_usuario_id,
            'crea_fecha' => $this->crea_fecha,
            'modi_usuario_id' => $this->modi_usuario_id,
            'modi_fecha' => $this->modi_fecha,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'tienda', $this->tienda])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'imagen_id', $this->imagen_id])
            ->andFilterWhere(['like', 'visible', $this->visible])
            ->andFilterWhere(['like', 'terminada', $this->terminada])
            ->andFilterWhere(['like', 'bloqueada', $this->bloqueada])
            ->andFilterWhere(['like', 'notas_bloqueo', $this->notas_bloqueo])
            ->andFilterWhere(['like', 'cerrada_comentar', $this->cerrada_comentar])
            ->andFilterWhere(['like', 'notas_admin', $this->notas_admin]);

        return $dataProvider;
    }
}

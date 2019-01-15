<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UsuariosAviso;

/**
 * UsuariosAvisosSearch represents the model behind the search form of `app\models\UsuariosAviso`.
 */
class UsuariosAvisosSearch extends UsuariosAviso
{
    public $tipo;
    public $usuarioOrigen;
    public $usuarioDestino;
    public $anuncio;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'destino_usuario_id', 'origen_usuario_id', 'anuncio_id', 'comentario_id'], 'integer'],
            [['fecha_aviso', 'clase_aviso_id', 'texto', 'fecha_lectura', 'fecha_aceptado', 'tipo','usuarioOrigen','usuarioDestino','anuncio'], 'safe'],
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
        $query = UsuariosAviso::find();
        $query->joinWith(['avisosClientesOrigen aC'], true, 'LEFT OUTER JOIN');
        $query->joinWith(['avisosClientesDestino dC'], true, 'LEFT OUTER JOIN');
        $query->joinWith(['avisosAnuncio aA'], true, 'LEFT OUTER JOIN');


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['tipo']=[
            'asc'=>['clase_aviso_id'=>SORT_ASC],
            'desc'=>['clase_aviso_id'=>SORT_DESC],
            'defaut'=>SORT_ASC,
        ];

        $dataProvider->sort->attributes['usuarioOrigen']=[
            'asc'=>['aC.nick'=>SORT_ASC],
            'desc'=>['aC.nick'=>SORT_DESC],
            'defaut'=>SORT_ASC,
        ];

        $dataProvider->sort->attributes['usuarioDestino']=[
            'asc'=>['dc.nick'=>SORT_ASC],
            'desc'=>['dc.nick'=>SORT_DESC],
            'defaut'=>SORT_ASC,
        ];

        $dataProvider->sort->attributes['anuncio']=[
            'asc'=>['aA.titulo'=>SORT_ASC],
            'desc'=>['aA.titulo'=>SORT_DESC],
            'defaut'=>SORT_ASC,
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'fecha_aviso' => $this->fecha_aviso,
            'destino_usuario_id' => $this->destino_usuario_id,
            'origen_usuario_id' => $this->origen_usuario_id,
            'anuncio_id' => $this->anuncio_id,
            'comentario_id' => $this->comentario_id,
            'fecha_lectura' => $this->fecha_lectura,
            'fecha_aceptado' => $this->fecha_aceptado,
            'clase_aviso_id' => $this->tipo,
            'aC.nick' => $this->usuarioOrigen,
            'dc.nick' => $this->usuarioDestino,
            'aA.titulo' => $this->anuncio,
        ]);

        $query->andFilterWhere(['like', 'clase_aviso_id', $this->clase_aviso_id])
            ->andFilterWhere(['like', 'texto', $this->texto]);

        return $dataProvider;
    }
}

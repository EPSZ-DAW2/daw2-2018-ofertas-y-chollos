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
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'destino_usuario_id', 'origen_usuario_id', 'anuncio_id', 'comentario_id'], 'integer'],
            [['fecha_aviso', 'clase_aviso_id', 'texto', 'fecha_lectura', 'fecha_aceptado'], 'safe'],
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
            'fecha_aviso' => $this->fecha_aviso,
            'destino_usuario_id' => $this->destino_usuario_id,
            'origen_usuario_id' => $this->origen_usuario_id,
            'anuncio_id' => $this->anuncio_id,
            'comentario_id' => $this->comentario_id,
            'fecha_lectura' => $this->fecha_lectura,
            'fecha_aceptado' => $this->fecha_aceptado,
        ]);

        $query->andFilterWhere(['like', 'clase_aviso_id', $this->clase_aviso_id])
            ->andFilterWhere(['like', 'texto', $this->texto]);

        return $dataProvider;
    }
}

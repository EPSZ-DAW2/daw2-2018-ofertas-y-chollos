<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Anuncio_comentario;

/**
 * Anuncio_comentarioSearch represents the model behind the search form of `app\models\Anuncio_comentario`.
 */
class Anuncio_comentarioSearch extends Anuncio_comentario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'anuncio_id', 'comentario_id', 'num_denuncias', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
            [['texto', 'cerrado', 'fecha_denuncia1', 'bloqueado', 'fecha_bloqueo', 'notas_bloqueo', 'crea_fecha', 'modi_fecha'], 'safe'],
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
        $query = Anuncio_comentario::find();

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
            'anuncio_id' => $this->anuncio_id,
            'comentario_id' => $this->comentario_id,
            'num_denuncias' => $this->num_denuncias,
            'fecha_denuncia1' => $this->fecha_denuncia1,
            'fecha_bloqueo' => $this->fecha_bloqueo,
            'crea_usuario_id' => $this->crea_usuario_id,
            'crea_fecha' => $this->crea_fecha,
            'modi_usuario_id' => $this->modi_usuario_id,
            'modi_fecha' => $this->modi_fecha,
        ]);

        $query->andFilterWhere(['like', 'texto', $this->texto])
            ->andFilterWhere(['like', 'cerrado', $this->cerrado])
            ->andFilterWhere(['like', 'bloqueado', $this->bloqueado])
            ->andFilterWhere(['like', 'notas_bloqueo', $this->notas_bloqueo]);

        return $dataProvider;
    }
}

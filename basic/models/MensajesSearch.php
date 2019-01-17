<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Mensaje;

/**
 * MensajesSearch represents the model behind the search form of `app\models\Mensaje`.
 */
class MensajesSearch extends Mensaje
{
    public $usuarioOrigen;
    public $usuarioDestino;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'origen_usuario_id', 'destino_usuario_id'], 'integer'],
            [['fecha_hora', 'texto','usuarioOrigen','usuarioDestino'], 'safe'],
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
        $query = Mensaje::find();
        $query->joinWith(['avisosClientesOrigen aC'], true, 'LEFT OUTER JOIN');
        $query->joinWith(['avisosClientesDestino dC'], true, 'LEFT OUTER JOIN');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

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

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'fecha_hora' => $this->fecha_hora,
            'origen_usuario_id' => $this->origen_usuario_id,
            'destino_usuario_id' => $this->destino_usuario_id,
        ]);

        $query->andFilterWhere(['like', 'texto', $this->texto])
            ->andFilterWhere(['like', 'aC.nick', $this->usuarioOrigen])
            ->andFilterWhere(['like', 'dc.nick', $this->usuarioDestino]);

        return $dataProvider;
    }
}

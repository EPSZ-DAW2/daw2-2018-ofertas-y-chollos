<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UsuariosAreaModeracion;

/**
 * UsuariosAreaModeracionSearch represents the model behind the search form of `app\models\UsuariosAreaModeracion`.
 */
class UsuariosAreaModeracionSearch extends UsuariosAreaModeracion
{
    public $zona;
    public $usuario;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'usuario_id', 'zona_id'], 'integer'],
            [['usuario', 'zona'], 'safe'],
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
        $query = UsuariosAreaModeracion::find();

        // add conditions that should always apply here

        $query->joinWith(['zonaOrdenar zO'], true, 'LEFT OUTER JOIN');
        $query->joinWith(['usuarioOrdenar uO'], true, 'LEFT OUTER JOIN');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['usuario']=[
            'asc'=>['uO.nick'=>SORT_ASC],
            'desc'=>['uO.nick'=>SORT_DESC],
            'defaut'=>SORT_ASC,
        ];
        $dataProvider->sort->attributes['zona']=[
            'asc'=>['zO.nombre'=>SORT_ASC],
            'desc'=>['zO.nombre'=>SORT_DESC],
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
            'usuario_id' => $this->usuario_id,
            'uO.nick'=>$this->usuario,
            'zO.nombre' => $this->zona,
        ]);

        return $dataProvider;
    }
}

<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Zonas;

/**
 * zonasSearch represents the model behind the search form of `app\models\zonas`.
 */
class zonasSearch extends zonas
{
    public $claseZona;
    public $zonaPadre;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'zona_id'], 'integer'],
            [['claseZona', 'nombre', 'zonaPadre'], 'safe'],
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
     
    public function getZonaId($nombre=null){
        if(!is_null($nombre) && ($nombre!='')) return array_search($nombre, Zonas::$zonas);
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
        $query = zonas::find();

        // add conditions that should always apply here

        $query->joinWith(['padreOrdenar pO'], true, 'LEFT OUTER JOIN');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

         $dataProvider->setSort([
            'attributes' => [
                'id',
                
                'nombre',
                'claseZona' => [
                    'asc' => ['clase_zona_id' => SORT_ASC],
                    'desc' => ['clase_zona_id' => SORT_DESC],
                    'default' => SORT_ASC
                ],
                'zona_id',
                'zonaPadre'=>[
                    'asc' => ['pO.nombre' => SORT_ASC],
                    'desc' => ['pO.nombre' => SORT_DESC],
                    'default' => SORT_ASC
                ]
            ]
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
//print_r(Zonas::$zonas);
        // grid filtering conditions
        $query->andFilterWhere([
            'zonas.id' => $this->id,
            'zonas.clase_zona_id' => $this->getZonaId($this->claseZona),
 //           'pO.nombre' => $this->zonaPadre,
        ]);

        $query->andFilterWhere(['like', 'clase_zona_id', $this->clase_zona_id])
            ->andFilterWhere(['like', 'zonas.nombre', $this->nombre])
            ->andFilterWhere(['like', 'pO.nombre', $this->zonaPadre]);

        return $dataProvider;
    }
}

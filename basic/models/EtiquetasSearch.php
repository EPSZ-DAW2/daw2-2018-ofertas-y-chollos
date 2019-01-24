<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Etiqueta;
use app\controllers\EtiquetasController;
use yii\grid\ActionColumn;


/**
 * EtiquetasSearch represents the model behind the search form of `app\models\Etiqueta`.
 */
class EtiquetasSearch extends Etiqueta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nombre', 'descripcion'], 'safe'],
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
        $query = Etiqueta::find();

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
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
	
	public static function mostrarEtiquetas()
    {   

        //$con = new CategoriasController('categorias','app');
        $query=Etiqueta::find()->all();
        $eti=new ActiveDataProvider(['query'=>$query]);
       
        foreach ($query as $key => $value) {
            echo '<p>';
            
			//echo $value['id'];
            echo Html::a(Yii::t('app', $value['nombre']), ['site/index','id_etiqueta'=>$value['id']]);
             // echo Html::a(Yii::t('app', $value['nombre']), ['view?id='.$value['id']], ['class' => 'btn btn-success']);
            echo '</p>';
            
        }
		
    }
}

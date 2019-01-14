<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\AutoComplete;
use yii\widgets\Pjax;
use app\models\Categorias;
use app\models\CategoriasSearch;


/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categorias');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorias-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Crear Categoria'), ['create'], ['class' => 'btn btn-success']) ?>
	</p>
	<p>
		<?= CategoriasSearch::arbolCategorias();?>
	</p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'descripcion:ntext',
            'icono',
            'categoria_id',
			//'padre.nombre',
			['attribute' => 'nombCatId',
                'label' => 'Nombre Categoria ID',
                'value' => 'padre.nombre',              
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

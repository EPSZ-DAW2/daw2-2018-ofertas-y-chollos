<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedor */

$this->title = 'Prv ' . $model->id_y_usuario;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Proveedores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proveedor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'usuario_id',
			[
				'label' => 'Usuario',
				'format'=>'raw',
				'value' => Html::a(Yii::t('app', $model->id_y_usuario), ['usuarios/view', 'id' => $model->id]),
			],
            'nif_cif',
            'razon_social',
            'telefono_comercio',
            'telefono_contacto',
            'url:ntext',
            'fecha_alta',
        ],
    ]) ?>
	
	<div style="overflow-x:auto;">	
		<?= GridView::widget([
			'dataProvider' => new ActiveDataProvider([
				'query' => $model->getAnuncios(),  //devuelve "ActiveQuery" de Ficheros
				//'pagination'=>false,
				'sort'=>false,
			]),
			//'filterModel' => $searchModel,
			'summary' => '<h3>Anuncios publicados</h3>',
			'columns' => [
				['class' => 'yii\grid\SerialColumn'],

				//'id',
				'titulo:ntext',
				/*[
					'label' => 'Título',
					'format'=> 'raw',
					//'value' => Html::a(Yii::t('app', 'titulo:ntext'), ['anuncios/view', 'id' => $model->id]),
				],*/
				'descripcion:ntext',
				'crea_fecha',
				'tienda:ntext',
				'url:ntext',
				//'fecha_desde',
				//'fecha_hasta',
				//'precio_oferta',
				//'precio_original',
				//'zona_id',
				//'categoria_id',
				//'imagen_id',
				//'votosOK',
				//'votosKO',
				//'proveedor_id',
				//'prioridad',
				//'visible',
				//'terminada',
				//'fecha_terminacion',
				//'num_denuncias',
				//'fecha_denuncia1',
				//'bloqueada',
				//'fecha_bloqueo',
				//'notas_bloqueo:ntext',
				//'cerrada_comentar',
				//'crea_usuario_id',
				//'modi_usuario_id',
				//'modi_fecha',
				//'notas_admin:ntext',
			],
		]); ?>
	</div>

</div>

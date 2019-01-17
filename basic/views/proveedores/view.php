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
	
	<div class="jumbotron">
		  <h1 class="display-4"><?= Html::a(Yii::t('app', $usuario->nick), ['usuarios/view', 'id' => $usuario->id]) ?></h1>
		  <p class="lead"><?= $usuario->nombre ?> <?= $usuario->apellidos ?></p>
		  <p class="lead"><?= $usuario->email ?></p>
		  <hr class="my-4">
		  <p><strong>Fecha registro:</strong> <?= $usuario->fecha_registro ?></p>
		  <p><strong>¿Bloqueado?:</strong> <?php if($usuario->bloqueado == 0) echo 'No'; else echo 'Si';?></p>
	</div>

</div>

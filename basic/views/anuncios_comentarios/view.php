<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Anuncio_comentario */

$this->title = $model->id_y_anuncio;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comentarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anuncio-comentario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php // echo Html::a(Yii::t('app', 'Bloquear'), ['bloquear', 'id' => $model->id], ['class' => 'btn btn-danger',]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
			'id',
            //'anuncio_id',
			'id_y_anuncio',
            //'crea_usuario_id',
			[
				'label' => 'Usuario',
				'format'=>'raw',
				'value' => Html::a(Yii::t('app', $model->id_y_usuario), ['usuarios/view', 'id' => $model->id]),
			],
            'texto:ntext',
            'comentario_id',
            'cerrado',
            //'num_denuncias',
			[
				'label' => 'Nº denuncias',
				'format'=>'raw',
				'value' => $model->num_denuncias . ' ' . Html::a(Yii::t('app', 'Bloquear'), ['bloquear', 'id' => $model->id], ['class' => 'btn btn-danger',]),
				'contentOptions' => ['class' => 'text-danger'],
			],
            'fecha_denuncia1',
            'bloqueado',
            'fecha_bloqueo',
            'notas_bloqueo:ntext',
            'crea_fecha',
            'modi_usuario_id',
            'modi_fecha',
        ],
    ]) ?>
	
	<div class="jumbotron">
		  <h1 class="display-4"><?= Html::a(Yii::t('app', $anuncio->titulo), ['anuncios/view', 'id' => $anuncio->id]) ?></h1>
		  <p class="lead"><?= $anuncio->descripcion ?></p>
		  <hr class="my-4">
		  <p><strong>Votos OK:</strong> <?= $anuncio->votosOK ?></p>
		  <p><strong>Votos KO:</strong> <?= $anuncio->votosKO ?></p>
		  <p><strong>Fecha creaci?n:</strong> <?= $anuncio->crea_fecha ?></p>
		  <p><strong>?Bloqueado?:</strong> <?php if($anuncio->bloqueada == 0) echo 'No'; else echo 'Si';?></p>
		  <p><strong>?Visible?:</strong> <?php if($anuncio->visible == 0) echo 'No'; else echo 'Si';?></p>
	</div>

</div>

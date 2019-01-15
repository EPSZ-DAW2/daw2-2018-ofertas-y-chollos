<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PerfilSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mi Perfil');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-index">

	<!--Main layout-->
	
	<div class="row">
	
		<div class="col-md-4">

			<div class="widget-wrapper">
				<h4>Usuarios:</h4>
				<br>
				<div class="list-group">
					<?= Html::a('Modificar', ['perfil/update'], ['class' => 'list-group-item']) ?>
					<?= Html::a('Cambio de contraseña', ['perfil/pass'], ['class' => 'list-group-item']) ?>
					<?= Html::a('Solicitud de Baja', ['perfil/baja'], ['class' => 'list-group-item']) ?>
					<?= Html::a('Anuncios creados', ['perfil/anuncios'], ['class' => 'list-group-item']) ?>
					<?= Html::a('Comentarios', ['perfil/comentarios'], ['class' => 'list-group-item']) ?>
					<?= Html::a('Avisos', ['perfil/avisos'], ['class' => 'list-group-item']) ?>
					<?= Html::a('Chats', ['mensajes/listar'], ['class' => 'list-group-item']) ?>
				</div>
			</div>
		</div>

<div class="perfil-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<!-- No interesa crear, solo ver
    <p>
        <?= Html::a(Yii::t('app', 'Create Perfil'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
-->
<!--Main column-->
		<div class="col-md-8">

			<!--First row-->
			<div class="row">
					<div class="col-md-12">
						<div class="divider-new">
							<h1 class="h1-responsive">Perfil</h1>
						</div>
					<?= DetailView::widget([
						 'model' => $model,
        'attributes' => [
							//['class' => 'yii\grid\SerialColumn'],

							//'id',
							'email:email',
							//'password',
							'nick',
							'nombre',
							'apellidos',
							'fecha_nacimiento',
							'direccion:ntext',
							//'zona_id',
							//'fecha_registro',
							//'confirmado',
							//'fecha_acceso',
							//'num_accesos',
							//'bloqueado',
							//'fecha_bloqueo',
							//'notas_bloqueo:ntext',

				//		['class' => 'yii\grid\ActionColumn'],
						],
					]); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
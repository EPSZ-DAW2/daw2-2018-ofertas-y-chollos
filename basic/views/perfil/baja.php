<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PerfilSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Solicitar Baja: {nameAttribute}', [
    'nameAttribute' => $model->nick,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mi Perfil'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Solicitar Baja');
?>
<div class="perfil-index">

    <h1><?= Html::encode($this->title) ?></h1>
 
<!--Main column-->

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
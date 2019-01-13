<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

	<!--Main layout-->
	
	<div class="row">
	
		<div class="col-md-4">

			<div class="widget-wrapper">
				<h4>Usuarios:</h4>
				<br>
				<div class="list-group">
					<?= Html::a('Usuarios', ['usuarios/index'], ['class' => 'list-group-item']) ?>
					<?= Html::a('Proveedores', ['proveedores/index'], ['class' => 'list-group-item']) ?>
					<?= Html::a('Perfil', ['perfil/index'], ['class' => 'list-group-item']) ?>
					<?= Html::a('Avisos', ['usuarios-avisos/index'], ['class' => 'list-group-item']) ?>
					<?= Html::a('Mensajes', ['mensajes/index'], ['class' => 'list-group-item']) ?>
				</div>
			</div>
			
			<div class="widget-wrapper">
				<h4>Anuncios:</h4>
				<br>
				<div class="list-group">
					<?= Html::a('Anuncios', ['anuncios/index'], ['class' => 'list-group-item']) ?>
					<?= Html::a('Comentarios', ['anuncios_comentarios/index'], ['class' => 'list-group-item']) ?>
				</div>
			</div>
			
			<div class="widget-wrapper">
				<h4>Zonas:</h4>
				<br>
				<div class="list-group">
					<?= Html::a('Zonas', ['zonas/index'], ['class' => 'list-group-item']) ?>
					<?= Html::a('Moderación', ['usuarios-area-moderacion/index'], ['class' => 'list-group-item']) ?>
				</div>
			</div>
			
			<div class="widget-wrapper">
				<h4>Logs:</h4>
				<br>
				<div class="list-group">
					<?= Html::a('Logs', ['registros/index'], ['class' => 'list-group-item']) ?>
				</div>
			</div>
		</div>

		<!--Main column-->
		<div class="col-md-8">

			<!--First row-->
			<div class="row">
				<div class="col-md-12">
					<div class="divider-new">
						<h1 class="h1-responsive"><?= Html::a('Logs', ['registros/index']) ?></h1>
					</div>
					
					<?= GridView::widget([
						'dataProvider' =>  $dataProvider,
						//'filterModel' => $searchModel,
						//'summary' => '<h3>Registros</h3>',
						'columns' => [
							['class' => 'yii\grid\SerialColumn'],

							//'id',
							'tipo',
							'fecha_registro',
							'modulo',
							//'texto:ntext',
							//'ip',
							//'browser:ntext',
						],
					]); ?>
					
				</div>
			</div>
			<!--/.First row-->

		</div>
		<!--/.Main column-->

	</div>
    
</div>

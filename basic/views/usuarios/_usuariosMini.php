<?php
use yii\helpers\Html;

?>
	<!--Card-->
	<div class="card col-md-3" style="margin: 5px">
		<!--Card content-->
		<div class="card-block">
		<!--Title-->
			<h2><?= Html::encode($model->nick) ?> </h2>
			<h5 class="card-title"><?= Html::encode($model->nombre) ?> <?= Html::encode($model->apellidos) ?></h5>
			<!--Text-->
			<p class="card-text">Nacido en <?= Html::encode($model->fecha_nacimiento) ?></p>
			<?= Html::a('Iniciar Chat', ['/mensajes/iniciar', 'id_destino'=>$model->id], ['class'=>'btn btn-primary']) ?>
		</div>
			<!--/.Card content-->

	</div>
	<!--/.Card-->
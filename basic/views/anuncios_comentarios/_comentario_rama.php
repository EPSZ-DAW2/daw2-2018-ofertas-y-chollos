<?php

use yii\helpers\Html;
use yii\web\View;


?>

<div class="comentario-mini" id="<?=$model->id?>_coment">

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title"><?= $model->usuario ?></h3>
			<p><?= $model->crea_fecha ?></p>
		</div>
		<div class="panel-body">
			<p class="text"><?= $model->texto ?></p>
		</div>
	</div>
	
</div>
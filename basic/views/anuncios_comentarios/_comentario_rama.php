<?php

use yii\helpers\Html;
use yii\web\View;


?>

<div class="comentario-mini" id="<?=$model->id?>_coment">
	
	<div class="card">
		<div class="card-block">
			<p><strong><?= $model->usuario ?></strong></p>
			<p class="text-muted"><?= $model->crea_fecha ?></p>
			<p class="card-text"><?= $model->texto ?></p>
		</div>
	</div>
	
</div>
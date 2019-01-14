<?php

use yii\helpers\Html;
use yii\helpers\Url;


?>

<div class="card col-md-3">

	<!--Imagen del anuncio-->
			<div class="view overlay hm-white-slight">
				<!-- OJO! -->
			<img <?=($model->imagen_id == null)?'src="'.Url::base().'/imagenes/anuncios/anuncio_default.png"':'src="https://'.$model->imagen_id.'"'; ?>class="img-fluid" alt="">
				<a href="#">
				<div class="mask waves-effect waves-light"></div>
				</a>
			</div>


	<!--/.Imagen del anuncio-->
	<!--Contenido del anuncio-->
	<div class="card-block">
		<!--Titulo del anuncio-->
		<h4 class="card-title"> <?= Html::encode($model->titulo); ?></h4>
			<p class="card-text"><?= Html::encode($model->precio_oferta); ?>&nbsp;<span><?= Html::encode($model->precio_original); ?></span></p>
			<!--descripcion del anuncio-->
			<p class="card-text"><?= Html::encode($model->descripcion); ?></p>

				<!--añadir enlace a la vista detallada del anuncio ($model->id) -->
				<a href="#" class="btn btn-primary waves-effect waves-light">Ir a la ganga</a>

			</div>
				<!--/.Card content-->

		</div>
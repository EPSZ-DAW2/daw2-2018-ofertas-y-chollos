<?php

use yii\helpers\Html;
use yii\helpers\Url;

$desactivado = ($model->terminada > 0)?true:false;

?>

<div class="<?= ($desactivado)?'card-terminada-blur':''?>">

	<div class="card col-md-4 <?= ($desactivado)?' card-terminada-gris':''?>">

		<!--Imagen del anuncio-->
				<div class="view overlay hm-white-slight">
					<!-- OJO! modificar cuando este claro que se guarda en el campo imagen_id de la base de datos..-->
				<img <?=($model->imagen_id == null)?'src="'.Url::base().'/imagenes/anuncios/anuncio_default.png"':'src="https://'.$model->imagen_id.'"'; ?>class="img-fluid no-descuadrar-img" alt="">
					<!-- Enlazar la imagen con la vista detallada del anuncio!-->
					<?=Html::a('<div class="mask waves-effect waves-light"></div>', ['anuncios/ver', 'id'=>$model->id])?>
					
				</div>

		<!--/.Imagen del anuncio-->	
		

		<span class="fecha-publicacion"/>
			<?php //cuanto hace que se creo el anuncio...
			if($model->crea_fecha !=null || $model->crea_fecha != 0) echo " hace ".humanTiming($model->crea_fecha);
			else echo "sin fecha"; ?>
			</span>
		
			<div class="votos">
				<?php

				if(!$desactivado)
					echo Html::a('K.O.', ['anuncios/votarko', 'id'=>$model->id], ['class' =>'btn btn-default btn-circle color-gris']);
				else echo "<span class='btn btn-circle color-gris'>¡</span>";		
				?>
					<?php 

					$numero_votos = $model->votosOK-$model->votosKO;

					if($numero_votos > 0){  ?>

						<span class="numero-votos-positivo">

					<?php }if($numero_votos == 0){  ?>

						<span class="numero-votos-neutral">

					<?php }if($numero_votos < 0){ ?>

						<span class="numero-votos-negativo">
					<?php } 

					 echo Html::encode($numero_votos); ?>
					 	
					 	</span>

				<?php if(!$desactivado)
					echo Html::a('OK!', ['anuncios/votarok', 'id'=>$model->id], ['class' =>'btn btn-default btn-circle']);
					else echo "<span class='btn btn-circle color-gris'>!</span>";	
				?>
			</div>
		
		<!--Contenido del anuncio-->
		<div class="card-block">
			<!--Titulo del anuncio-->

			<h4 class="card-title"> <?= Html::a($model->titulo, ['anuncios/ver', 'id'=>$model->id], ['class' =>'waves-effect waves-light']) ?></h4>
				<p class="card-text"><?php 

				//mostrar el precio del chollaso, el precio original
				//y el porcentaje de descuento...
				echo "<span class='precio-oferta'>";
				echo Html::encode($model->precio_oferta);
				echo "€</span>";
				echo "&nbsp;";
				if($model->precio_original != null){
					echo "<span class='precio-original'>";
					echo  Html::encode($model->precio_original);
					echo "€</span>";
					echo "&nbsp;";
					$descuento = $model->precio_original - $model->precio_oferta;
					$descuento = -1*($descuento / $model->precio_oferta )*100;
					$descuento = round($descuento, 0);
					echo "<span class='porcentaje-descuento'>(".$descuento."%)</span>";
				} ?>

				</span></p>

				<!--descripcion del anuncio-->
				<p class="card-text no-descuadrar-desc">
				<?php

				//si la descripcion es muy larga, la recortamos un poco para no descuadrar el coso
				if(strlen($model->descripcion) > 50){
						$model->descripcion = substr($model->descripcion,0,45);
						echo Html::encode($model->descripcion)."...".Html::a('(ver más)', ['anuncios/ver', 'id'=>$model->id]);
				} 
				else 	echo Html::encode($model->descripcion);
					
				?>	

				</p>

					<!--añadir enlace a la vista detallada del anuncio ($model->id) -->

				<?php
				
				//si la url del anuncio es nula, link directo a la vista detallada.
				if($model->url == null)	echo Html::a('Ir a la ganga', ['anuncios/ver', 'id'=>$model->id], ['class' =>'btn btn-primary waves-effect waves-light btn-block']);
				else echo Html::a('Ir a la ganga', Url::to($model->url, true), ['class' =>'btn btn-primary waves-effect waves-light btn-block']);
				
				?>
				

				</div>
					<!--/.Card content-->

		</div>
	</div>

	<!--mover al css final !-->
	<style>
		
		.precio-oferta{
			font-size:200%;
			font-weight: bolder;
			color:orange;
		}

		.precio-original{
			color:#898989;
			text-decoration:line-through;
		}

		.porcentaje-descuento{
			color:black;
			font-style: italic;
		}


		.no-descuadrar-img {
	    width: 100%;
	    height: 15rem;
	    object-fit: cover;
		}

		.no-descuadrar-desc {
	    width: 100%;
	    height: 3rem;
	    object-fit: cover;
		}
		
		.btn-circle {
	    width: 30px;
	    height: 30px;
	    padding: 6px 0px;
	    border-radius: 15px;
	    text-align: center;
	    font-size: 12px;
	    line-height: 1.42857;
	    font-weight: bold;
		}
		.color-gris{
		background-color:grey;
		}

		.fecha-publicacion{

			float:right;
			font-style: italic;
			font-size:85%;
		}

		.votos{
			margin-top:2px;			
			display:inline-block;
			border-radius: 17px 17px 17px 17px;
			-moz-border-radius: 17px 17px 17px 17px;
			-webkit-border-radius: 17px 17px 17px 17px;
			border: 1px inset #dedede;

		}
		.card-terminada-gris{

		    -webkit-filter: grayscale(1);
		    filter: gray;
		    filter: grayscale(1);


		}
		.card-terminada-blur{
			
			filter:blur(1px);
		}

		.numero-votos-positivo{

			font-weight: bolder;
			color:#2BBBAD;
		}

		.numero-votos-neutral{

			font-weight: bolder;
			color:gray;
		}

		.numero-votos-negativo{

			font-weight: bolder;
			color:red;
		}



</style>
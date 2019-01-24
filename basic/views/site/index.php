<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\ListView;
use app\models\zonas;
use app\models\Categorias;
use app\models\Etiqueta;
use app\models\Anuncio;
use yii\web\View;


/* @var $this yii\web\View */

$js = <<<SCRIPT
	function mostrarFiltro(elem) {
		
		document.getElementById("zonas").style.display = "none";
		document.getElementById("categorias").style.display = "none";
		document.getElementById("simple").style.display = "none";
		 document.getElementById(elem).style.display = "block";
		
	}
SCRIPT;
$this->registerJs($js, View::POS_BEGIN);


$this->title = 'My Yii Application';
?>
<div class="site-index">


	<div class="row">

		<!--2º Navbar-->
		<nav class="navbar navbar-light navbar2">
			<!-- Collapse button-->
            <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#collapse2">
                <i class="fa fa-bars"></i>
            </button>
			
			<div class="collapse navbar-toggleable-xs container" id="collapse2">
				<?php
					echo Menu::widget([
						'options' => [
							"id"  => "nav",
							"class" => "nav navbar-nav"
						],
						'items' => [
							['label' => 'Filtros', 'template' => 
							'<div class="dropdown">
								<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									{label}
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" href="#" onclick="mostrarFiltro('.'\'zonas\''.');">Buscar por zonas</a>
									<a class="dropdown-item" href="#" onclick="mostrarFiltro('.'\'categorias\''.');">Buscar por categor?as</a>
									<a class="dropdown-item" href="#" onclick="mostrarFiltro('.'\'etiquetas\''.');">Busqueda por etiquetas</a>
									<a class="dropdown-item" href="#" onclick="mostrarFiltro('.'\'simple\''.');">Busqueda simple</a>
								</div>
							</div>'
							,'options' => [ "class" => "nav-item"]],
							['label' => 'Nuevos', 'url' => ['index'],'options' => [ "class" => "nav-item"]],
							['label' => 'Populares', 'url' => ['index', 'filtro' => 'pop'], 'options' => [ "class" => "nav-item"]],
							['label' => 'Pr?ximos', 'url' => ['index', 'filtro' => 'rec'], 'options' => [ "class" => "nav-item"]],
							['label' => 'Busqueda Avanzada', 'url' => ['anuncios/busquedaavanzada'], 'options' => [ "class" => "nav-item"]],
						],
					]);
				?>
				
			</div>
		</div>

		<div class="card" style="display:none;" id="zonas">
			<div class="card-block">
				<?php 
					echo \Yii::$app->view->renderFile('@app/views/zonas/busqueda.php', [
						'model'=> new Zonas,
					]);
				?>
			</div>
		</div>
		<div style="display:none;" id="categorias">
			<div class="card-block">
				<?php 
					echo \Yii::$app->view->renderFile('@app/views/categorias/busqueda.php', [
						'model'=> new Categorias,
					]);
				?>
			</div>
		</div>
		<div style="display:none;" id="simple">
			<div class="card-block">
				<?php 
					echo \Yii::$app->view->renderFile('@app/views/anuncios/_searchsimple.php', [
						'model'=> new Anuncio,
					]);
				?>
			</div>
		</div>
		<div style="display:none;" id="etiquetas">
			<div class="card-block">
				<?php 
					echo \Yii::$app->view->renderFile('@app/views/etiquetas/busquedaetiquetas.php', [
						'model'=> new Etiqueta,
					]);
				?>
			</div>
		</div>
	
		<?= ListView::widget([
			'dataProvider' => $dataProvider,
			'itemView' =>  '../anuncios/_anunciosMini',
			'layout' => '{items}<div style="clear: both;"></div>{pager}',
			
			/*'layout' => 
			'<div class="container container-fluid">{items}</div> 
				<div>
					{pager}
					<select class="custom-select" style="margin-bottom: 15px;">
					  <option value="10" '.( (strcasecmp( $nPages, '10') == 0) ? 'selected' : '').'>Mostrar 10 gangas</option>
					  <option value="25" '.( (strcasecmp( $nPages, '25') == 0) ? 'selected' : '').'>Mostrar 25 gangas</option>
					  <option value="50" '.( (strcasecmp( $nPages, '50') == 0) ? 'selected' : '').'>Mostrar 50 gangas</option>
					  <option value="75" '.( (strcasecmp( $nPages, '75') == 0) ? 'selected' : '').'>Mostrar 75 gangas</option>
					  <option value="100" '.( (strcasecmp( $nPages, '100') == 0) ? 'selected' : '').'>Mostrar 100 gangas</option>
					  <option value="1" '.( (strcasecmp( $nPages, '1') == 0) ? 'selected' : '').'>Mostrar todas las gangas</option>
					</select>
					{summary}
				</div>'*/
		]); ?>    

	</div>
    
</div>

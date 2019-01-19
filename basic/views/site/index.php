<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\ListView;
use app\models\zonas;
use yii\web\View;


/* @var $this yii\web\View */

$js = <<<SCRIPT
	function mostrarFiltro(elem) {
		
		
		if (elem == "zonas") {
			if (document.getElementById("zonas").style.display == "none") {
			  document.getElementById("zonas").style.display = "block";
			} else {
			  document.getElementById("zonas").style.display = "none";
			}
			if (document.getElementById("categorias").style.display == "block") {
			  document.getElementById("categorias").style.display = "none";
			}
		}
		if (elem == "categorias") {
			if (document.getElementById("categorias").style.display == "none") {
			  document.getElementById("categorias").style.display = "block";
			} else {
			  document.getElementById("categorias").style.display = "none";
			}
			if (document.getElementById("zonas").style.display == "block") {
			  document.getElementById("zonas").style.display = "none";
			}
		}
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
								</div>
							</div>'
							,'options' => [ "class" => "nav-item"]],
							['label' => 'Nuevos', 'url' => ['index'],'options' => [ "class" => "nav-item"]],
							['label' => 'Populares', 'url' => ['index', 'filtro' => 'pop'], 'options' => [ "class" => "nav-item"]],
							['label' => 'Pr?ximos', 'url' => ['index', 'filtro' => 'rec'], 'options' => [ "class" => "nav-item"]],
						],
					]);
				?>
				
			</div>
		</div>
		
		<div style="display:none;" id="zonas">
			<?php 
				echo \Yii::$app->view->renderFile('@app/views/zonas/busqueda.php', [
					'model'=> new Zonas,
				]);
			?>
		</div style="display:none;" id="categorias">
		<div>
			<?php 

			?>
		</div>
	
		<?= ListView::widget([
			'dataProvider' => $dataProvider,
			'itemView' =>  '../anuncios/_anunciosMini',
			
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

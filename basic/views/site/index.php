<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\ListView;


/* @var $this yii\web\View */

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
							['label' => 'Nuevos', 'url' => ['index'],'options' => [ "class" => "nav-item"]],
							['label' => 'Populares', 'url' => ['index', 'filtro' => 'pop'], 'options' => [ "class" => "nav-item"]],
							['label' => 'Recientes', 'url' => ['index', 'filtro' => 'rec'], 'options' => [ "class" => "nav-item"]],
						],
					]);
				?>
			</div>
			<!--/.Collapse content-->
		</div>
	
		<?= ListView::widget([
			'dataProvider' => $dataProvider,
			'itemView' =>  '../anuncios/_anunciosMini',
			'layout' => '<div class="container container-fluid">{items}</div> 
				<div>
					{pager}
					<select class="custom-select">
					  <option value="10" '.( (strcasecmp( $nPages, '10') == 0) ? 'selected' : '').'>Mostrar 10 gangas</option>
					  <option value="25" '.( (strcasecmp( $nPages, '25') == 0) ? 'selected' : '').'>Mostrar 25 gangas</option>
					  <option value="50" '.( (strcasecmp( $nPages, '50') == 0) ? 'selected' : '').'>Mostrar 50 gangas</option>
					  <option value="75" '.( (strcasecmp( $nPages, '75') == 0) ? 'selected' : '').'>Mostrar 75 gangas</option>
					  <option value="100" '.( (strcasecmp( $nPages, '100') == 0) ? 'selected' : '').'>Mostrar 100 gangas</option>
					  <option value="1" '.( (strcasecmp( $nPages, '1') == 0) ? 'selected' : '').'>Mostrar todas las gangas</option>
					</select>
					{summary}
				</div>'
		]); ?>    

	</div>
    
</div>

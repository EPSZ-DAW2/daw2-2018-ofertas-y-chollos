<?php

use yii\helpers\Html;
use yii\widgets\Menu;


/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">


	<div class="row">

		<!--2º Navbar-->
		<nav class="navbar navbar-light navbar2">
			<div class="collapse navbar-toggleable-xs container" id="collapseEx">
				<?php
					echo Menu::widget([
						'options' => [
							"id"  => "nav",
							"class" => "nav navbar-nav"
						],
						'items' => [
							['label' => 'Destacados', 'url' => ['#'], 'options' => [ "class" => "nav-item"]],
							['label' => 'Populares', 'url' => ['#'], 'options' => [ "class" => "nav-item"]],
							['label' => 'Nuevos', 'url' => ['#'],'options' => [ "class" => "nav-item"]],
						],
					]);
				?>
				<!--Search form-->
				<form class="form-inline">
					<input class="form-control" type="text" placeholder="Search">
				</form>
			</div>
			<!--/.Collapse content-->
		</div>
	
		<!--Main column-->
		<div class="col-md-8">

			<!--First row-->
			<div class="row">
				<div class="col-md-12">
					<div class="divider-new">
						<h2 class="h2-responsive"><?php echo Html::encode(\Yii::$app->name); ?></h2>
					</div>
					<!--Carousel Wrapper-->
					<div id="carousel-example-2" class="carousel slide carousel-fade z-depth-1-half" data-ride="carousel">
						<!--Indicators-->
						<ol class="carousel-indicators">
							<li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
							<li data-target="#carousel-example-2" data-slide-to="1"></li>
							<li data-target="#carousel-example-2" data-slide-to="2"></li>
						</ol>
						<!--/.Indicators-->

						<!--Slides-->
						<div class="carousel-inner" role="listbox">
							<div class="carousel-item active">
								<img src="https://i.imgur.com/97FlKd2.jpg" class="" alt="First slide">
								<div class="carousel-caption">
									<h4>New collection</h4>
									<br>
								</div>
							</div>
							<div class="carousel-item">
								<img src="https://i.imgur.com/RNZjqM1.jpg" class="" alt="Second slide">
								<div class="carousel-caption">
									<h4>Get discount!</h4>
									<br>
								</div>
							</div>
							<div class="carousel-item">
								<img src="http://i.imgur.com/sg1vEqQ.jpg" class="" alt="Third slide">
								<div class="carousel-caption">
									<h4>Only now for 10$</h4>
									<br>
								</div>
							</div>
						</div>
						<!--/.Slides-->

						<!--Controls-->
						<a class="left carousel-control" href="#carousel-example-2" role="button" data-slide="prev">
							<span class="icon-prev" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carousel-example-2" role="button" data-slide="next">
							<span class="icon-next" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
						<!--/.Controls-->
					</div>
					<!--/.Carousel Wrapper-->
				</div>
			</div>
			<!--/.First row-->
			<br>
			<hr class="extra-margins">

			<!--Second row-->
			<div class="row">
				<!--First columnn-->
				<div class="col-md-6">
					<!--Card-->
					<div class="card">

						<!--Card image-->
						<div class="view overlay hm-white-slight">
							<img src="https://i.imgur.com/RNZjqM1.jpg" class="img-fluid" alt="">
							<a href="#">
								<div class="mask"></div>
							</a>
						</div>
						<!--/.Card image-->

						<!--Card content-->
						<div class="card-block">
							<!--Title-->
							<h4 class="card-title">Product title</h4>
							<!--Text-->
							<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
							<a href="#" class="btn btn-primary">Buy now for 10$</a>
						</div>
						<!--/.Card content-->

					</div>
					<!--/.Card-->
				</div>
				<!--First columnn-->

				<!--Third columnn-->
				<div class="col-md-6">
					<!--Card-->
					<div class="card">

						<!--Card image-->
						<div class="view overlay hm-white-slight">
							<img src="https://i.imgur.com/sg1vEqQ.jpg" class="img-fluid" alt="">
							<a href="#">
								<div class="mask"></div>
							</a>
						</div>
						<!--/.Card image-->

						<!--Card content-->
						<div class="card-block">
							<!--Title-->
							<h4 class="card-title">Product title</h4>
							<!--Text-->
							<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
							<a href="#" class="btn btn-primary">Buy now for 30$</a>
						</div>
						<!--/.Card content-->

					</div>
					<!--/.Card-->
				</div>
				<!--Third columnn-->
			</div>
			<!--/.Second row-->

		</div>
		<!--/.Main column-->

		<!--Sidebar-->
		<div class="col-md-4">

			<div class="widget-wrapper">
				<h4>Categories:</h4>
				<br>
				<div class="list-group">
					<a href="#" class="list-group-item active">Woman</a>
					<a href="#" class="list-group-item">Man</a>
					<a href="#" class="list-group-item">Shoes</a>
					<a href="#" class="list-group-item">T-shirt</a>
					<a href="#" class="list-group-item">Jewellery</a>
				</div>
			</div>

			<div class="widget-wrapper">
				<h4>Subscription form:</h4>
				<br>
				<div class="card">
					<div class="card-block">
						<p><strong>Subscribe to our newsletter</strong></p>
						<p>Once a week we will send you a summary of the most useful news</p>
						<div class="md-form">
							<i class="fa fa-user prefix"></i>
							<input type="text" id="form1" class="form-control">
							<label for="form1">Your name</label>
						</div>
						<div class="md-form">
							<i class="fa fa-envelope prefix"></i>
							<input type="text" id="form2" class="form-control">
							<label for="form2">Your email</label>
						</div>
						<button class="btn btn-primary">Submit</button>

					</div>
				</div>
			</div>

		</div>
		<!--/.Sidebar-->

	</div>
    
</div>

<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use app\widgets\Alert;

/**
 * @var $this \yii\base\View
 * @var $content string
 */
// $this->registerAssetBundle('app');
?>
<?php $this->beginPage(); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?php echo Html::encode(\Yii::$app->name); ?></title>
	
    <?= Html::csrfMetaTags() ?>

    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $this->theme->baseUrl ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="<?php echo $this->theme->baseUrl ?>/css/mdb.min.css" rel="stylesheet">
	
	<!-- JoseCM css -->
    <link href="<?php echo $this->theme->baseUrl ?>/css/daw2.css" rel="stylesheet">

    <!-- Template styles -->
    <link href="<?php echo $this->theme->baseUrl ?>/css/style.css" rel="stylesheet">

    <style>
        body {
			background-color: white;
		}

		.primary-color-dark {
			background-color: #000 !important;
		}

		.btn.btn-primary {
			background-color: #000;
		}
    
		.list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {
			background-color: #000;
			border-color: #000;
		}
    </style>

</head>

<body>

<?php $this->beginBody() ?>

    <header>

        <!--Navbar-->
        <nav class="navbar navbar-dark primary-color-dark">

            <!-- Collapse button-->
            <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#collapseEx">
                <i class="fa fa-bars"></i>
            </button>

            <div class="container">

                <!--Collapse content-->
                <?= Html::a(Yii::t('app', Html::encode(\Yii::$app->name)), ['site/index'], ['class' => 'navbar-brand band-invisible']) ?>
                <div class="collapse navbar-toggleable-xs" id="collapseEx">
                    <!--Navbar Brand-->
                    <?= Html::a(Yii::t('app', Html::encode(\Yii::$app->name)), ['site/index'], ['class' => 'navbar-brand band-visible']) ?>
					<!--Links-->
                    <?php
						echo Menu::widget([
							'options' => [
								"id"  => "nav",
								"class" => "nav navbar-nav"
							],
							'items' => [
								['label' => 'About', 'url' => ['site/about'], 'options' => [ "class" => "nav-item down"]],
								['label' => 'Contact', 'url' => ['site/contact'], 'options' => [ "class" => "nav-item"]],
								['label' => 'Gestión', 'url' => ['gestion/index'],'options' => [ "class" => "nav-item"]
									//, 'visible'=>Yii::$app->user->can('administrador')
								],
								Yii::$app->user->isGuest ? (
									['label' => 'Conectar', 'url' => ['/usuarios/login'], 'options' => [ "class" => "nav-item"]]
								) : (
									['label' => 'Logout ('.Yii::$app->user->identity->nick.')', 'url' => ['/usuarios/logout'],'options' => [ "class" => "nav-item"]]
								)
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

        </nav>
        <!--/.Navbar-->
		
    </header>

	<main>
		
		<div class="body-content">
			<div class="container">
				<div class="row">
				  <div class="col-md-12">
					 <?= Breadcrumbs::widget([
						'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
					]) ?>
					<?= Alert::widget() ?>
					 <?php echo $content; ?>
				  </div>
				</div>
			</div>
		</div>
	<!--/.Main layout-->
	</main>

    <!--Footer-->
    <footer class="page-footer center-on-small-only primary-color-dark">

        <!--Footer Links-->
        <div class="container-fluid">
            <div class="row">

                <!--First column-->
                <div class="col-md-3 col-md-offset-1">
                    <h5 class="title">Sobre nustra copia de CHOLLOMETRO</h5>
                    <p>Aqui vamos a poner algo interesante para que parezca que sabemos lo que hacemos.</p>

                    <p>Y aqui pondremos alguna chorrada más sobre la aplicación de chollometro que seguro copiaremos de ahí XD.</p>
                </div>
                <!--/.First column-->

                <hr class="hidden-md-up">

                <!--Second column-->
                <div class="col-md-2 col-md-offset-1">
                    <h5 class="title">First column</h5>
                    <ul>
                        <li><a href="#!">Link 1</a></li>
                        <li><a href="#!">Link 2</a></li>
                        <li><a href="#!">Link 3</a></li>
                        <li><a href="#!">Link 4</a></li>
                    </ul>
                </div>
                <!--/.Second column-->

                <hr class="hidden-md-up">

                <!--Third column-->
                <div class="col-md-2">
                    <h5 class="title">Second column</h5>
                    <ul>
                        <li><a href="#!">Link 1</a></li>
                        <li><a href="#!">Link 2</a></li>
                        <li><a href="#!">Link 3</a></li>
                        <li><a href="#!">Link 4</a></li>
                    </ul>
                </div>
                <!--/.Third column-->

                <hr class="hidden-md-up">

                <!--Fourth column-->
                <div class="col-md-2">
                    <h5 class="title">Third column</h5>
                    <ul>
                        <li><a href="#!">Link 1</a></li>
                        <li><a href="#!">Link 2</a></li>
                        <li><a href="#!">Link 3</a></li>
                        <li><a href="#!">Link 4</a></li>
                    </ul>
                </div>
                <!--/.Fourth column-->

            </div>
        </div>
        <!--/.Footer Links-->

        <hr>

        <!--Call to action-->
        <div class="call-to-action">
            <h4><?php echo Html::encode(\Yii::$app->name); ?></h4>
        </div>
        <!--/.Call to action-->

        <!--Copyright-->
        <div class="footer-copyright">
            <div class="container-fluid">
               Copyright &copy; 2019 - made with <span style="color:red;"><i class="fab fa-rebel"></i></span> by TODOS NOSOSTROS <i class="fas fa-fire"></i>

            </div>
        </div>
        <!--/.Copyright-->

    </footer>
    <!--/.Footer-->


    <!-- SCRIPTS -->

    <!-- JQuery -->
    <script type="text/javascript" src="<?php echo $this->theme->baseUrl ?>/js/jquery-2.2.3.min.js"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="<?php echo $this->theme->baseUrl ?>/js/tether.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="<?php echo $this->theme->baseUrl ?>/js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="<?php echo $this->theme->baseUrl ?>/js/mdb.min.js"></script>

    <script>
      // ugly MDB fix http://i.imgur.com/WFl7fkh.jpg
      $(function(){
        $("#nav li a").addClass("nav-link");
      });
    </script>

    <?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>

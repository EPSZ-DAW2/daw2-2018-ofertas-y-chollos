<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\web\View;

//registro codigo css para probar los estilos
$css2 = <<<CSS
.cita {
	display: none;
	border-left: 2px solid grey;
	color: grey;
	padding-left: 5px;
	margin: 5px 15px -15px 15px;
}

.comment_input {
	margin: 20px 0px;
}

.rojo, .rojo:hover {
	color: red;
}
CSS;

$this->registerCss($css2, []);

/* @var $this yii\web\View */
/* @var $model app\models\Anuncio_comentario */

$this->title = 'Comentarios del chollo 1';
?>
<div class="anuncio-comentario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_comentario',
				'layout' => '{summary}<hr/>{items}<div style="clear:both"></div>{pager}',
				'summary' => '{count} COMENTARIOS',
    ]); ?> 
	
</div>


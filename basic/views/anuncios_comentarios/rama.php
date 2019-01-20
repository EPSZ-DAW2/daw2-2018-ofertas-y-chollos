<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Anuncio_comentario */

$this->title = 'Rama comentarios';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comentarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="anuncio-comentario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_comentario_rama', ['model'=>$model]);?>
	
	<div style="border-left: 2px solid blue; padding-left: 10px; margin: 20px 0;">
		<?= ListView::widget([
			'dataProvider' => $dataProvider,
			'itemView' => '_comentario_rama',
					'layout' => '{summary}<hr/>{items}<div style="clear:both"></div>{pager}',
					'summary' => '<h4>Los {count} comentarios que mencionan a este son:</h4>',
		]); ?> 
	</div>
	
	<p>
        <?php 
			echo Html::a('Cerrar rama', ['cerrar', 'id' => $model->id], ['class' => 'btn btn-danger']);
			echo Html::a('Cerrar toda la rama', ['cerrartodo', 'id' => $model->id], ['class' => 'btn btn-danger']);
		?>
    </p>

</div>

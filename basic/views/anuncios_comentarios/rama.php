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

    <?php var_dump($model); ?>
	
	
	<?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_comentario_rama',
				'layout' => '{summary}<hr/>{items}<div style="clear:both"></div>{pager}',
				'summary' => 'Los {count} comentarios que mencionan a este son:',
    ]); ?> 
	
	<p>
        <?php 
			$models = $dataProvider->getModels();
			var_dump($models);
			echo Html::a('Cerrar rama', ['cerrar', 'models' => $models], ['class' => 'btn btn-danger']);
			echo Html::a('Cerrar toda la rama', ['cerrarTodo', 'models' => $models], ['class' => 'btn btn-danger']);
		?>
    </p>

</div>

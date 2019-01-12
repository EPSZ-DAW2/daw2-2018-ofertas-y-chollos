<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Anuncio_comentario;

/* @var $this yii\web\View */
/* @var $model app\models\Anuncio_comentario */

$this->title = Yii::t('app', 'Bloquear: {nameAttribute}', [
    'nameAttribute' => $model->id_y_anuncio,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Anuncio Comentarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Bloquear';
?>
<div class="anuncio-comentario-update">

    <h1><?= Html::encode($this->title) ?></h1>
	
	
	<div class="card">
		<div class="card-block">
			<p><strong><?= $model->usuario ?></strong></p>
			<p class="text-muted"><?= $model->crea_fecha ?></p>
			<p class="card-text"><?= $model->texto ?></p>
		</div>
	</div>
	
	<p><strong>Nº denuncias:</strong> <span class="text-danger"><?= $model->num_denuncias ?></span></p>
	<?php if($model->num_denuncias == 0) { ?>
		<p><strong>Primera denuncia:</strong> <?= $model->fecha_denuncia1 ?></p>
	<?php } ?>
	
	
    <?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'bloqueado')->dropDownList($model::$bloqueados)->label('Motivo del bloqueo') ?>

		<?php // echo $form->field($model, 'fecha_bloqueo')->textInput(['disabled' => true]) ?>

		<?= $form->field($model, 'notas_bloqueo')->textarea(['rows' => 6]) ?>

		<div class="form-group">
			<?= Html::submitButton(Yii::t('app', 'Bloquear'), ['class' => 'btn btn-success']) ?>
		</div>

    <?php ActiveForm::end(); ?>

</div>
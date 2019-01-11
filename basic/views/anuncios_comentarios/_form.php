<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Anuncio_comentario;

/* @var $this yii\web\View */
/* @var $model app\models\Anuncio_comentario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anuncio-comentario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'anuncio_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'comentario_id')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'cerrado')->textInput() ?>
	<?= $form->field($model, 'cerrado')->dropDownList($model::$cerrados) ?>

    <?= $form->field($model, 'num_denuncias')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'fecha_denuncia1')->textInput(['disabled' => true]) ?>

    <?php // echo $form->field($model, 'bloqueado')->textInput() ?>
	<?= $form->field($model, 'bloqueado')->dropDownList($model::$bloqueados) ?>

    <?= $form->field($model, 'fecha_bloqueo')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'notas_bloqueo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'crea_usuario_id')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <?= $form->field($model, 'crea_fecha')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'modi_usuario_id')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <?= $form->field($model, 'modi_fecha')->textInput(['disabled' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

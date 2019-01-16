<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Perfil */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perfil-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password2')->hiddenInput(['maxlength' => true])->label(false) ?>
    <?= $form->field($model, 'password3')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'nick')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_nacimiento')->textInput() ?>

    <?= $form->field($model, 'direccion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'zona_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_registro')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'confirmado')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'fecha_acceso')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'num_accesos')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'bloqueado')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'fecha_bloqueo')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'notas_bloqueo')->hiddenInput(['rows' => 6])->label(false) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

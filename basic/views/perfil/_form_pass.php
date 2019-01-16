<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Perfil */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perfil-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->hiddenInput(['maxlength' => true])->label(false)?>

    <?= $form->field($model, 'anpassword')->passwordInput(['maxlength' => true, 'required'=>true]) ?>
   <?= $form->field($model, 'password3')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'password2')->passwordInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'nick')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'nombre')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'apellidos')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'fecha_nacimiento')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'direccion')->hiddenInput(['rows' => 6])->label(false) ?>

    <?= $form->field($model, 'zona_id')->hiddenInput(['maxlength' => true])->label(false) ?>

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

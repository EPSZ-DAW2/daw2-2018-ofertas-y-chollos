<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\UsuariosAviso;

/* @var $this yii\web\View */
/* @var $model app\models\UsuariosAviso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-aviso-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha_aviso');?>

    <?= $form->field($model, 'clase_aviso_id')->dropDownList($model::$tipos, ['prompt' => 'Seleccione Uno' ]);   ?>

    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'destino_usuario_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'origen_usuario_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anuncio_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comentario_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_lectura')->textInput() ?>

    <?= $form->field($model, 'fecha_aceptado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

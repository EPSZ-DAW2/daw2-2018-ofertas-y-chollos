<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnunciosEtiquetas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anuncios-etiquetas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'anuncio_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'etiqueta_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

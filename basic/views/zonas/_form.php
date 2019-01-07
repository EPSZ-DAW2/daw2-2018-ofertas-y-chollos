<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\zonas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zonas-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'clase_zona_id')->dropDownList([ 1=>'Continente', 2=>'Pais', 3=>'Estado', 4=>'Region', 5=>'Provincia', 6=>'Municipio', 7=>'Localidad', 8=>'Barrio', 9=>'Area'], ['prompt' => 'Seleccione Uno' ]);   ?>
    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zona_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

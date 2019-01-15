<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\zonas;

/* @var $this yii\web\View */
/* @var $model app\models\zonas */
/* @var $form yii\widgets\ActiveForm */
//$zon=Zonas::find()->select('id', 'nombre')->all();

$zon=array();
$zon = ArrayHelper::map(Zonas::find()->where(['<','clase_zona_id', $_POST["Tipo"]])->all(), 'id','nombre');
?>



<div class="zonas-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'clase_zona_id')->hiddenInput(['maxlength' => true])->label(false) ?>
   
    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zona_id')->dropDownList($zon, ['prompt' => 'Seleccione Uno']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<span id="resultado"></span>
</div>

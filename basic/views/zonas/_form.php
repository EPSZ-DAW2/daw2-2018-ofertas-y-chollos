<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Zonas;


/* @var $this yii\web\View */
/* @var $model app\models\zonas */
/* @var $form yii\widgets\ActiveForm */
$zona = Zonas::find()->all();
$zonalista=ArrayHelper::map($zona,'id','nombre');
?>

<div class="zonas-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'clase_zona_id')->dropDownList($model::$zonas, ['prompt' => 'Seleccione Uno' ]);   ?>
    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zona_id')->dropdownList(
			$zonalista,
	    	['prompt'=>'Selecciona una zona']); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

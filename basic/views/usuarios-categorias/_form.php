<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuariosCategorias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-categorias-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'usuario_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoria_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_seguimiento')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

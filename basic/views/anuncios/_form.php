<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Anuncio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anuncio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tienda')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'url')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fecha_desde')->textInput() ?>

    <?= $form->field($model, 'fecha_hasta')->textInput() ?>

    <?= $form->field($model, 'precio_oferta')->textInput() ?>

    <?= $form->field($model, 'precio_original')->textInput() ?>

    <?= $form->field($model, 'zona_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoria_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imagen_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'votosOK')->textInput() ?>

    <?= $form->field($model, 'votosKO')->textInput() ?>

    <?= $form->field($model, 'proveedor_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prioridad')->textInput() ?>

    <?= $form->field($model, 'visible')->textInput() ?>

    <?= $form->field($model, 'terminada')->textInput() ?>

    <?= $form->field($model, 'fecha_terminacion')->textInput() ?>

    <?= $form->field($model, 'num_denuncias')->textInput() ?>

    <?= $form->field($model, 'fecha_denuncia1')->textInput() ?>

    <?= $form->field($model, 'bloqueada')->textInput() ?>

    <?= $form->field($model, 'fecha_bloqueo')->textInput() ?>

    <?= $form->field($model, 'notas_bloqueo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cerrada_comentar')->textInput() ?>

    <?= $form->field($model, 'crea_usuario_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'crea_fecha')->textInput() ?>

    <?= $form->field($model, 'modi_usuario_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'modi_fecha')->textInput() ?>

    <?= $form->field($model, 'notas_admin')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

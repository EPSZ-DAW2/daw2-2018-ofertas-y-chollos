<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegistrosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registro-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fecha_registro') ?>

    <?= $form->field($model, 'clase_log_id') ?>

    <?= $form->field($model, 'modulo') ?>

    <?= $form->field($model, 'texto') ?>

    <?php // echo $form->field($model, 'ip') ?>

    <?php // echo $form->field($model, 'browser') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

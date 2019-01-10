<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Registro */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Limpieza';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Registros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Inserte la fecha a partir de la que desea eliminar registros</h1>
<div class="registro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha_limpieza')->input('date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Eliminar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

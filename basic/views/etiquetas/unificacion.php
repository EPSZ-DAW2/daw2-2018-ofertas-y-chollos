<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Etiqueta */

$this->title = Yii::t('app', 'Unificar etiquetas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Etiquetas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etiqueta-create">

    <h1><?= Html::encode($this->title) ?></h1>

<div class="etiqueta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->dropDownList($listaDeEtiquetas)->label('Etiqueta que va a permanecer'); ?>

    <?= $form->field($model, 'descripcion')->dropDownList($listaDeEtiquetas)->label('Etiqueta que será eliminada') ?>
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>

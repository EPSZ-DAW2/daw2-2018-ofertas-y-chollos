<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;



$this->title = Yii::t('app', 'Unificar categorias');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categorias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorias-create">

    <h1><?= Html::encode($this->title) ?></h1>




<div class="categoria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->dropDownList($listaDeCategorias)->label('Categoria que va a permanecer'); ?>

    <?= $form->field($model, 'descripcion')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'icono')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'categoria_id')->dropDownList($listaDeCategorias)->label('Categoria que será eliminada'); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


</div>

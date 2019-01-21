<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Anuncio;
/* @var $this yii\web\View */
/* @var $model app\models\AnunciosEtiquetas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anuncios-etiquetas-form">

    <?php $form = ActiveForm::begin();  ?>

    <?= $form->field($model, 'anuncio_id')->hiddenInput(['maxlength' => true]) ?>
<h3><?=Anuncio::findOne($model->anuncio_id)->titulo?></h3>
    <?= $form->field($model, 'etiqueta_id')->dropdownList($etiquetas) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UsuariosAreaModeracion */

$this->title = Yii::t('app', 'Update Usuarios Area Moderación: {nameAttribute}', [
    'nameAttribute' => $model->usuario. '-'. $model->zona
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios Area Moderación'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->usuario. '-'. $model->zona, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="usuarios-area-moderacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

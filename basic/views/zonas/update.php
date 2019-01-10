<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\zonas */

$this->title = Yii::t('app','Update Zonas: {nameAttribute}', [
    'nameAttribute' => $model->nombre,
]);
$this->params['breadcrumbs'][] = ['label' => 'Zonas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="zonas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

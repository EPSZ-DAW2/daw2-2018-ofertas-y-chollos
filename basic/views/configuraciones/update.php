<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Configuracion */

$this->title = Yii::t('app', 'Update Configuracion: {name}', [
    'name' => $model->variable,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configuracions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->variable, 'url' => ['view', 'id' => $model->variable]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="configuracion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

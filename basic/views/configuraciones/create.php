<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Configuracion */

$this->title = Yii::t('app', 'Create Configuracion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configuracions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="configuracion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

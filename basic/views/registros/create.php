<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Registro */

$this->title = Yii::t('app', 'Create Registro');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Registros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registro-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

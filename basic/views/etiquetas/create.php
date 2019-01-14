<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Etiqueta */

$this->title = Yii::t('app', 'Create Etiqueta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Etiquetas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etiqueta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

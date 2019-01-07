<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Anuncio_comentario */

$this->title = Yii::t('app', 'Create Anuncio Comentario');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Anuncio Comentarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anuncio-comentario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

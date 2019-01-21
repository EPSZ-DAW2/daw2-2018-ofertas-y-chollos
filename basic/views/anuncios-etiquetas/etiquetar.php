<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnunciosEtiquetas */

$this->title = Yii::t('app', 'Etiquetar');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Anuncios Etiquetas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anuncios-etiquetas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_etiquetar', [
        'model' => $model,
        'etiquetas'=>$etiquetas
    ]) ?>

</div>

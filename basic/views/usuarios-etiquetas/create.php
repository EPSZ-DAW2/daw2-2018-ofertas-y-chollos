<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UsuariosEtiquetas */

$this->title = Yii::t('app', 'Create Usuarios Etiquetas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios Etiquetas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-etiquetas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

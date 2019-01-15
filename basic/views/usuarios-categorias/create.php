<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UsuariosCategorias */

$this->title = Yii::t('app', 'Create Usuarios Categorias');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios Categorias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-categorias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

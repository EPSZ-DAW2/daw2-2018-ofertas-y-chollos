<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'email:email',
            'password',
            'nick',
            'nombre',
            'apellidos',
            'fecha_nacimiento',
            'direccion:ntext',
            'zona_id',
            'fecha_registro',
            'confirmado',
            'fecha_acceso',
            'num_accesos',
            'bloqueado',
            'fecha_bloqueo',
            'notas_bloqueo:ntext',
        ],
    ]) ?>


    <h1>¿Confirmar usuario?</h1>
    
    <p><?= Html::a('CONFIRMAR', ['usuarios/confirmar', 'id'=>$model->id, 'confirmar'=>"1"], ['class' =>'profile-link']) ?></p>


</div>
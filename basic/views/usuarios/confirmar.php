<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = "Registro Completado";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-view">

    <h1>Registro Completado, Solo un paso más!</h1>
    <h3>Confirma tu registro pulsando en enlace de abajo</h3>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'email:email',
            'nick',
            'nombre',
            'apellidos',
            'fecha_nacimiento',
            'direccion:ntext',
            'fecha_registro'
             ],
    ]) ?>


    <h1>¿Confirmar usuario?</h1>
    
    <p><?= Html::a('CONFIRMAR', ['usuarios/confirmar', 'id'=>$model->id, 'confirmar'=>"1"], ['class' =>'btn btn-primary']) ?></p>


</div>
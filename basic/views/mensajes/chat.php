<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MensajesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

    $id=Yii::$app->user->id;
    if($mensajes[0]->origen_usuario_id!=$id)
    {
        $destino=$mensajes[0]->origen_usuario_id;
    }
    else
    {
        $destino=$mensajes[0]->destino_usuario_id;
    }

$this->title = Yii::t('app', $mensajes[0]->nick);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chats'), 'url' => ['listar']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mensaje-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php
    echo time();
        foreach ($mensajes as $mensaje)
        {
            echo '<hr>';
            echo "<p style='text-align: right;'>".$mensaje->texto.'<br>'.$mensaje->fecha_hora.'</p>';
            //echo $mensaje->nick;
        }
    ?>
    <?php Pjax::end(); ?>
    
    <?php $form = ActiveForm::begin(['action' => ['enviar'],]); ?>
    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'origen_usuario_id')->hiddenInput([$id])->label(false); ?>
    <?= $form->field($model, 'destino_usuario_id')->hiddenInput([$destino])->label(false); ?>
    <?= Html::submitButton(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
</div>
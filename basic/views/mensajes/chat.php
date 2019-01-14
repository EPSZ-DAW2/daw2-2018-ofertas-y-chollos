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
    <div id='chat' style="max-height: 400px; height:400px; overflow-y: scroll; padding: 20px;">
    <?php
        foreach ($mensajes as $mensaje)
        {
            if($id==$mensaje->origen_usuario_id)
            {
                $align='right';
            }
            else
            {
                $align='left';
            }
            echo '<hr>';
            echo "<div style='text-align:".$align.";'>".$mensaje->texto.'<br>'.$mensaje->fecha_hora.'</div>';
            //echo $mensaje->nick;
        }
    ?>
    </div>

    
    <?php Pjax::end(); ?>
    
    <?php $form = ActiveForm::begin(['action' => ['enviar'],]); ?>
    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'origen_usuario_id')->hiddenInput(['value' => $id])->label(false) ?>
    <?= $form->field($model, 'destino_usuario_id')->hiddenInput(['value' => $destino])->label(false); ?>
    <?= Html::submitButton(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
</div>
<script>
    
    (function () {
    var chatBox, message, sendButton, messageItem;

    chatBox = document.querySelector('#chat');
    message = document.querySelector('#message');
    sendButton = document.querySelector('#send-message');

    sendButton.addEventListener('click', function () {
        console.log(message.value);
        messageItem = document.createElement('div');
        messageItem.innerHTML = message.value
            .replace('<', '&lt;')
            .replace('>', '&gt;')
            .replace('"', '&quot;');
        chatBox.appendChild(messageItem);

        // aca lo interesante
        chatBox.scrollTop = chatBox.scrollHeight;
    });

})();
    </script>
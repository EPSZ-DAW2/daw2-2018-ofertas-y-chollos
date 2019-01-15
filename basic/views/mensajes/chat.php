<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MensajesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
    $id=Yii::$app->user->id;

$this->title = Yii::t('app', $nick);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chats'), 'url' => ['listar']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mensaje-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
	<?= Html::a("Refresh", ['actualizar', 'id_destino' => $destino], ['class' => 'btn btn-lg btn-primary','id' => 'refreshButton','style'=> 'visibility: hidden;' ]) ?>

    <div id='chat' style="max-height: 400px; height:400px; overflow-y: scroll; padding: 20px;">
    <?php
        foreach ($mensajes as $mensaje)
        {
            if($id==$mensaje->origen_usuario_id)
            {
                $align='right;color:green';
            }
            else
            {
                $align='left';
            }
            echo '<hr>';
            echo "<div style='text-align:".$align.";'>".$mensaje->texto.'<br>'.$mensaje->fecha_hora."</div>";
        }
    ?>
    </div>

        <?php
$script = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#refreshButton").click(); }, 3000);
    $("#chat").animate({ scrollTop: $('#chat')[0].scrollHeight},0);
});
JS;
$this->registerJs($script);

?>
    <?php Pjax::end(); ?>
    
    <?php $form = ActiveForm::begin(['action' => ['enviar'],]); ?>
    <?= $form->field($model, 'texto')->textInput(['autocomplete'=>"off",'autofocus' => 'autofocus']) ?>
    <?= $form->field($model, 'destino_usuario_id')->hiddenInput(['value' => $destino])->label(false); ?>
    <?= Html::submitButton(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
</div>
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\zonas */
/* @var $form yii\widgets\ActiveForm */
?>

<script type="text/javascript">
function realizaProceso(valorCaja, valor){
        var parametros = {
                "Tipo" : valorCaja,
                
        };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                url:   '?r=zonas%2Fcreate', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#resultado").html(response);
                }
        });
}
</script>

<div class="zonas-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'clase_zona_id')->dropDownList($model::$zonas, ['prompt' => 'Seleccione Uno', 'id'=>'tipo', 'onchange'=>"realizaProceso($('#tipo').val(), $('#ruta'));return false" ]);   ?>
    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zona_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<span id="resultado"></span>
</div>

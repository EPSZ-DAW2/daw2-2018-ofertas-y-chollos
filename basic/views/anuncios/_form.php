<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Anuncio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anuncio-form">

    <?php 
        $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); 
        $model->fecha_desde=date(" d/m/Y h:i");
        $model->fecha_hasta=date(" d/m/Y h:i");
        $model->precio_oferta=0;
        $model->precio_original=0;
       
        $model->visible=1; //visible 1 no visible 0
        $model->terminada=0; //  0=No, 1=Realizada, 2=Suspendida, 3=Cancelada por Inadecuada
        $model->num_denuncias=0; //Por defecto se inicializa en 0
        if($model->isNewRecord){//así se si estoy creando o modificando
            
             $model->crea_usuario_id= Yii::$app->user->isGuest ? 0 : Yii::$app->user->identity->id;
             $model->votosOK=0;
             $model->votosKO=0;
             $model->cerrada_comentar=0; //0=No, 1=Si.
             $model->zona_id = Yii::$app->user->isGuest ? 0 : Yii::$app->user->identity->zona_id;
             $model->bloqueada=0;
            
        }
       
    ?>

    <?= $form->field($model, 'titulo')->textarea(['rows' => 6])->label('Título del anuncio') ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6])->label('Descripción del anuncio') ?>

    <?= $form->field($model, 'tienda')->textarea(['rows' => 6])->label('Nombre de la tienda') ?>

    <?= $form->field($model, 'url')->textarea(['rows' => 6])->label('Url de la tienda') ?>

    <?= $form->field($model, 'fecha_desde')->textInput()->label('Fecha y Hora de inicio del anuncio/oferta ') ?>

    <?= $form->field($model, 'fecha_hasta')->textInput()->label('Fecha y Hora de fin del anuncio/oferta ') ?>

    <?= $form->field($model, 'precio_oferta')->textInput()->label('Precio del artículo en oferta') ?>

    <?= $form->field($model, 'precio_original')->textInput()->label('Precio del artículo antes de la oferta') ?>

    <?= $form->field($model, 'zona_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'categoria_id')->dropDownList($categorias)->label("Elija una categoria") ?>

    <?= $form->field($model, 'imagen_id')->textInput()->label("Pegue aquí la url de la imagen") ?> <!--MODIFICAR-->

    <?=$form->field($model, 'imageFile')->fileInput()?>

    <?= $form->field($model, 'votosOK')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'votosKO')->hiddenInput()->label(false)  ?>

    <?= $form->field($model, 'proveedor_id')->dropDownList($proveedores)->label("Elija un proveedor") ?>

    <?= $form->field($model, 'prioridad')->dropDownList(array(1,2,3,4,5,6,7,8,9,10), ['prompt' => 'Seleccione Uno','options'=>[["Selected"=>true]] ]) ?>

    <?= $form->field($model, 'visible')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'terminada')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'fecha_terminacion')->textInput()->label("Fecha y hora de finalización de la oferta") ?>

    <?= $form->field($model, 'num_denuncias')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'fecha_denuncia1')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'bloqueada')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'fecha_bloqueo')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'notas_bloqueo')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'cerrada_comentar')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'crea_usuario_id')->hiddenInput()->label(false) ?> 

    <?= $form->field($model, 'crea_fecha')->hiddenInput()->label(false)?>

    <?= $form->field($model, 'modi_usuario_id')->hiddenInput()->label(false) ?> 


    <?= $form->field($model, 'modi_fecha')->hiddenInput()->label(false)?>

    <?= $form->field($model, 'notas_admin')->hiddenInput(['rows' => 6])->label(false) ?> 



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', ($model->isNewRecord ? 'Publicar anuncio' : 'Guardar cambios')), ['class' => 'btn btn-success']) ?>    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Anuncio */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Anuncios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$url = $model->url==null ? 'Sin página web' : "<a href=$model->url> Ir a su web</a>";
$imagen = ($model->imagen_id == null) ? 'src="'.Url::base().'/imagenes/anuncios/anuncio_default.png"':'src="'.Url::base().'/imagenes/anuncios/'.$model->imagen_id.'"';
$activada = !Yii::$app->user->isGuest;//($model->terminada==0 && $model->bloqueada==0 && $model->visible==1);
?>
 

<div class="anuncio-view">

    <h1><?= Html::encode($this->title) ?></h1>

<center><img <?=$imagen?>alt=""></center>
    <div>
        <table><tr>
            <td>
               <?php
                if($activada)
                    echo Html::a('No me gusta', ['anuncios/votarko', 'id'=>$model->id],  ['class' => 'btn btn-danger']);
                else
                    echo "Dislikes&nbsp";

               ?>
           </td>
           <td width = "100%">
          <?=$model->votosKO?>
            </td>
            
            <td>
                <?=$model->votosOK?>
            </td>
            <td>
                
                <?php if($activada)
                    echo Html::a('Me  gusta! ', ['anuncios/votarok', 'id'=>$model->id], ['class' =>'btn btn-default btn-circle']);
                    else
                        echo "&nbsplikes"
                ?>
                
            </td>
            </tr>
            </div>
    <p>
        
 
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            ['label' => 'Titulo','format'=>'raw','value' => $model->titulo],
            ['label' => 'Descripción','format'=>'raw','value' => $model->descripcion],
            ['label' => 'Tienda','format'=>'raw','value' => $model->tienda],
            ['label' => 'Página web','format'=>'raw','value' => $url],
            ['label' => 'Comienza','format'=>'raw','value' => $model->fecha_desde],
            ['label' => 'Termina','format'=>'raw','value' => $model->fecha_hasta],
            ['label' => 'Precio Anterior','format'=>'raw','value' => $model->precio_original." €"],
            ['label' => 'Precio Actual','format'=>'raw','value' => $model->precio_oferta." €"],
            ['label' => 'Zona geográfica','format'=>'raw','value' =>$zona ],
            ['label' => 'Categoría','format'=>'raw','value' =>$categoria ],
            //'imagen_id',
            //['label' => 'Votos a favor','format'=>'raw','value' =>$modal ],
            //'votosKO',
          //  'proveedor_id',
          //  'prioridad',
          //'visible',
         //   'terminada',
           // 'fecha_terminacion',
            //'num_denuncias',
            //'fecha_denuncia1',
           // 'bloqueada',
           // 'fecha_bloqueo',
           // 'notas_bloqueo:ntext',
           // 'cerrada_comentar',
           // 'crea_usuario_id',
           // 'crea_fecha',
           // 'modi_usuario_id',
           // 'modi_fecha',
           // 'notas_admin:ntext',
        ],
    ]) ?>
<?= Html::a(Yii::t('app', 'Denunciar'), ['denunciar', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
</div>

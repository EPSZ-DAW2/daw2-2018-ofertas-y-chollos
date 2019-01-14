<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Anuncio */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Anuncios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anuncio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'titulo:ntext',
            'descripcion:ntext',
            'tienda:ntext',
            'url:ntext',
            'fecha_desde',
            'fecha_hasta',
            'precio_oferta',
            'precio_original',
            'zona_id',
            'categoria_id',
            'imagen_id',
            'votosOK',
            'votosKO',
            'proveedor_id',
            'prioridad',
            'visible',
            'terminada',
            'fecha_terminacion',
            'num_denuncias',
            'fecha_denuncia1',
            'bloqueada',
            'fecha_bloqueo',
            'notas_bloqueo:ntext',
            'cerrada_comentar',
            'crea_usuario_id',
            'crea_fecha',
            'modi_usuario_id',
            'modi_fecha',
            'notas_admin:ntext',
        ],
    ]) ?>
<?= Html::a(Yii::t('app', 'Votar a favor'), ['votarok', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<?= Html::a(Yii::t('app', 'Votar en contra'), ['votarko', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<?= Html::a(Yii::t('app', 'Denunciar'), ['denunciar', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
</div>

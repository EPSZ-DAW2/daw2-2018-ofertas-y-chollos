<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosAvisosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Avisos Zona Moderación');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-aviso-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Usuarios Aviso'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Limpiar'), ['limpieza'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'fecha_aviso',
            //'clase_aviso_id',
            'tipo',
            'texto:ntext',
            //'origen_usuario_id',
            'usuarioOrigen',
            //'destino_usuario_id',
            'usuarioDestino',
            //'anuncio_id',
            'anuncio',
            'comentario_id',
            'fecha_lectura',
            'fecha_aceptado',
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>

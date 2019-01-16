<?php

use yii\helpers\Html;
//use yii\widgets\ListView;
//use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\web\View;
use yii\grid\GridView;

$this->title = Yii::t('app', 'Avisos de {nameAttribute}', [
    'nameAttribute' => $model->nick,
]);

?>
<div class="avisos">
	<h1><?= Html::encode($this->title) ?></h1>
	<?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
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
           // 'usuarioDestino',
            //'anuncio_id',
            //'anuncio',
            'comentario_id',
            'fecha_lectura',
            'fecha_aceptado',
            
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    
</div>
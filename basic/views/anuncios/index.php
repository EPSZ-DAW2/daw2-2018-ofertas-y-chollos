<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AnuncioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Anuncios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anuncio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Nuevo anuncio'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'titulo:ntext',
            'descripcion:ntext',
            'tienda:ntext',
            //'url:ntext',
            //'fecha_desde',
            //'fecha_hasta',
            'precio_oferta',
            //'precio_original',
            //'zona_id',
            //'categoria_id',
            //'imagen_id',
            //'votosOK',
            //'votosKO',
            //'proveedor_id',
            //'prioridad',
            //'visible',
            //'terminada',
            //'fecha_terminacion',
            //'num_denuncias',
            //'fecha_denuncia1',
            //'bloqueada',
            //'fecha_bloqueo',
            //'notas_bloqueo:ntext',
            //'cerrada_comentar',
            //'crea_usuario_id',
            //'crea_fecha',
            //'modi_usuario_id',
            //'modi_fecha',
            //'notas_admin:ntext',

            ['class' => 'yii\grid\ActionColumn',


                'template' => '{viewadmin}{update}{delete}{bloquear}{terminar}',
                'buttons' => [
                    'viewadmin' => function ($url, $model) {
                        return Html::a('<i class="fas fa-eye"></i>', $url, [
                                    'title' => Yii::t('app', 'viewadmin'),
                        ]);
                    },
                    'bloquear' => function ($url, $model) {
                        return Html::a('<i class="fas fa-lock"></i>', $url, [
                                    'title' => Yii::t('app', 'bloquear'),
                        ]);
                    },
                    'terminar' => function ($url, $model) {
                        return Html::a('<i class="fas fa-hourglass-end"></i>', $url, [
                                    'title' => Yii::t('app', 'terminar'),
                        ]);
                    }


                ],
            ],



        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

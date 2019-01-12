<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\Anuncio_comentarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Comentarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anuncio-comentario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- Se comenta esto porque no se podrán crear comentarios desde aquí
	<p>
        <?php // echo Html::a(Yii::t('app', 'Crear comentario'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'id_y_anuncio',
            'anuncio_id',
			//'id_y_usuario',
            'crea_usuario_id',
            'texto:ntext',
            'comentario_id',
            'crea_fecha',
            'num_denuncias',
            'cerrado',
            'bloqueado',
            //'fecha_denuncia1',
            //'fecha_bloqueo',
            //'notas_bloqueo:ntext',
            //'modi_usuario_id',
            //'modi_fecha',

			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view}{update}{bloquear}{rama}',
				'buttons' => [
					'bloquear' => function ($url, $model) {
						return Html::a('<i class="fas fa-lock"></i>', $url, [
									'title' => Yii::t('app', 'bloquear'),
						]);
					},
					'rama' => function ($url, $model) {
						return Html::a('<i class="fas fa-sort-amount-up"></i>', $url, [
									'title' => Yii::t('app', 'rama'),
						]);
					}

				],
			],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PerfilSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mi Perfil');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perfil-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<!-- No interesa crear, solo ver
    <p>
        <?= Html::a(Yii::t('app', 'Create Perfil'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
           //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'email:email',
            'password',
            'nick',
            'nombre',
            'apellidos',
            'fecha_nacimiento',
            'direccion:ntext',
            //'zona_id',
            //'fecha_registro',
            //'confirmado',
            //'fecha_acceso',
            //'num_accesos',
            //'bloqueado',
            //'fecha_bloqueo',
            //'notas_bloqueo:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

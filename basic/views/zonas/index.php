<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Zonas;


/* @var $this yii\web\View */
/* @var $searchModel app\models\zonasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Zonas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zonas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear zona nueva', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           'id',
 //           'clase_zona_id',
            'nombre',
            'claseZona',
     //       'zona_id',
            'zonaPadre',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

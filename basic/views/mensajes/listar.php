<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MensajesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Chats');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mensaje-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    //print_r($lista);
    echo '<hr>';
    foreach($lista as $id => $nick)
    {
        echo "<h3>".$nick."</h3>";
        echo Html::a(Yii::t('app', 'Iniciar Chat'), ['iniciar', 'id_destino' => $id], ['class' => 'btn btn-success btn-lg']).'<hr>';
    }

    ?>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;

//funcion para mostrar cuanto tiempo hace que se publico el anuncio
function humanTiming ($time)
{
    $time = strtotime($time);
    $time = time() - $time;
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'año',
        2592000 => 'mes',
        604800 => 'semana',
        86400 => 'dia',
        3600 => 'hora',
        60 => 'minuto',
        1 => 'segundo'
    );
    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }

}

$this->title = Yii::t('app', 'Ofertas');


?>

<style>
 li {
  display:inline;
  margin: 1px;
}
</style>
<div class="anuncio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_anunciosMini',
        'layout' => '<div class="container container-fluid">{items}</div> <div>{pager}{summary}</div>'
    ]); ?>    

    <?php Pjax::end(); ?>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;


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

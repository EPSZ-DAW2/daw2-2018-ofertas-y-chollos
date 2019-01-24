<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Etiqueta;
use app\models\EtiquetasSearch;


$this->title = 'Etiquetas';
//$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    #menu * { list-style:none;}
    #menu li{ line-height:180%;}
    #menu li a{color:#00c851; text-decoration:none;}
    #menu input[name="list"] {
        position: absolute;
        left: -1000em;
        }
    #menu label:before{ content:"+"; margin-right:4px;}
    #menu input:checked ~ label:before{ content:"-";}
    #menu .interior{display: none;margin-left: 20px;}
    #menu input:checked ~ ul{display:block;}
    #menu .clase {font-size: 1.2rem;}
</style>
<div class="etiquetas-busqueda">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php EtiquetasSearch::mostrarEtiquetas();?>
    
    
</div>

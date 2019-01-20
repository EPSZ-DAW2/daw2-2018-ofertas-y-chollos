<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Zonas;


/* @var $this yii\web\View */
/* @var $searchModel app\models\zonasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Zonas';
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
<div class="zonas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
        $continentes=$model->continentes;
    ?>
    <ul id="menu">
        <?php
        foreach($continentes as $continente)
        {
        ?>
        <li><input type="checkbox" name="list" id="nivel1-<?= $continente->id?>"><label class="clase" for="nivel1-<?= $continente->id?>"><?= Html::a($continente->nombre, ['site/index', 'id_zona' => $continente->id]) ?></label>
            <ul class="interior">
                <?php
                $hijos1=$continente->hijos;
                foreach($hijos1 as $hijo)
                {
                ?>
                <li><input type="checkbox" name="list" id="nivel2-<?= $hijo->id?>"><label class="clase" for="nivel2-<?= $hijo->id?>"><?= Html::a($hijo->nombre, ['site/index', 'id_zona' => $hijo->id]) ?></label>
                    <ul class="interior">
                        <?php
                        $hijos2=$hijo->hijos;
                        foreach($hijos2 as $hijo)
                        {
                        ?>
                        <li><input type="checkbox" name="list" id="nivel3-<?= $hijo->id?>"><label class="clase" for="nivel3-<?= $hijo->id?>"><?= Html::a($hijo->nombre, ['site/index', 'id_zona' => $hijo->id]) ?></label>
                            <ul class="interior">
                                <?php
                                $hijos3=$hijo->hijos;
                                foreach($hijos3 as $hijo)
                                {
                                ?>
                                <li><input type="checkbox" name="list" id="nivel4-<?= $hijo->id?>"><label class="clase" for="nivel4-<?= $hijo->id?>"><?= Html::a($hijo->nombre, ['site/index', 'id_zona' => $hijo->id]) ?></label>
                                    <ul class="interior">
                                        <?php
                                        $hijos4=$hijo->hijos;
                                        foreach($hijos4 as $hijo)
                                        {
                                        ?>
                                        <li><input type="checkbox" name="list" id="nivel5-<?= $hijo->id?>"><label class="clase" for="nivel5-<?= $hijo->id?>"><?= Html::a($hijo->nombre, ['site/index', 'id_zona' => $hijo->id]) ?></label>
                                            <ul class="interior">
                                                <?php
                                                $hijos5=$hijo->hijos;
                                                foreach($hijos5 as $hijo)
                                                {
                                                ?>
                                                <li><input type="checkbox" name="list" id="nivel6-<?= $hijo->id?>"><label class="clase" for="nivel6-<?= $hijo->id?>"><?= Html::a($hijo->nombre, ['site/index', 'id_zona' => $hijo->id]) ?></label>
                                                    <ul class="interior">
                                                        <?php
                                                        $hijos6=$hijo->hijos;
                                                        foreach($hijos6 as $hijo)
                                                        {
                                                        ?>
                                                        <li><input type="checkbox" name="list" id="nivel7-<?= $hijo->id?>"><label class="clase" for="nivel7-<?= $hijo->id?>"><?= Html::a($hijo->nombre, ['site/index', 'id_zona' => $hijo->id]) ?></label>
                                                            <ul class="interior">
                                                                <?php
                                                                $hijos7=$hijo->hijos;
                                                                foreach($hijos7 as $hijo)
                                                                {
                                                                ?>
                                                                <li><input type="checkbox" name="list" id="nivel8-<?= $hijo->id?>"><label class="clase" for="nivel8-<?= $hijo->id?>"><?= Html::a($hijo->nombre, ['site/index', 'id_zona' => $hijo->id]) ?></label>
                                                                    <ul class="interior">
                                                                        <?php
                                                                        $hijos8=$hijo->hijos;
                                                                        foreach($hijos8 as $hijo)
                                                                        {
                                                                        ?>
                                                                        <li><input type="checkbox" name="list" id="nivel9-<?= $hijo->id?>"><label class="clase" for="nivel9-<?= $hijo->id?>"><?= Html::a($hijo->nombre, ['site/index', 'id_zona' => $hijo->id]) ?></label>
                                                                        </li>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </li>
                                                                <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                        </li>
                                                        <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
                <?php
                }
                ?>
            </ul>
        </li>
        <?php
        }
        ?>
    </ul>
</div>
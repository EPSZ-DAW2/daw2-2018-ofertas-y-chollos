<?php

use yii\helpers\Html;
use yii\widgets\ListView;
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
    <?php  echo $this->render('_searchavanzado', ['model' => $searchModel]); ?>

   

    <?= ListView::widget([
			'dataProvider' => $dataProvider,
			'itemView' =>  '_anunciosMini',
			'layout' => '{items}<div style="clear: both;"></div>{pager}',
			
			/*'layout' => 
			'<div class="container container-fluid">{items}</div> 
				<div>
					{pager}
					<select class="custom-select" style="margin-bottom: 15px;">
					  <option value="10" '.( (strcasecmp( $nPages, '10') == 0) ? 'selected' : '').'>Mostrar 10 gangas</option>
					  <option value="25" '.( (strcasecmp( $nPages, '25') == 0) ? 'selected' : '').'>Mostrar 25 gangas</option>
					  <option value="50" '.( (strcasecmp( $nPages, '50') == 0) ? 'selected' : '').'>Mostrar 50 gangas</option>
					  <option value="75" '.( (strcasecmp( $nPages, '75') == 0) ? 'selected' : '').'>Mostrar 75 gangas</option>
					  <option value="100" '.( (strcasecmp( $nPages, '100') == 0) ? 'selected' : '').'>Mostrar 100 gangas</option>
					  <option value="1" '.( (strcasecmp( $nPages, '1') == 0) ? 'selected' : '').'>Mostrar todas las gangas</option>
					</select>
					{summary}
				</div>'*/
		]); ?>    
		
</div>

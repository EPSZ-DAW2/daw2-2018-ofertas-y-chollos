<?php

use yii\helpers\Html;
use yii\web\View;
use app\models\Usuario;
//registro codigo css para probar los estilos
$css1 = <<<CSS
.comentario-mini {
	border-bottom: 1px solid grey;
	padding:15px 5px;
}
.comentario-mini .menor {
	color: grey;
	font-size: 13px;
}
.comentario-mini .up {
	margin-top: -10px;
}
.no-btn, .no-btn:hover {
	background-color: transparent;
	border: none;
	-webkit-box-shadow: none !important;
	box-shadow: none !important;
}
.citado {
	border-left: 2px solid blue;
	color: grey;
	padding-left: 5px;
}
.no-margin-bottom {
	margin-bottom: 0px;
}

.li_element:hover, .li_element:focus {
    color: #262626;
    text-decoration: none;
    background-color: #f5f5f5;
}
.li_element {
    display: block;
    padding: 3px 20px;
    clear: both;
    font-weight: normal;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
}
CSS;

$js1 = <<<SCRIPT
	function citar(id, user, texto) {
		document.getElementById('anuncio_comentario-comentario_id').value = id;
		document.getElementById('user').innerHTML = user;
		document.getElementById('texto').innerHTML = texto;
		document.getElementById("cita").style.display = "block";
	}
	
	function no_citar() {
		document.getElementById('anuncio_comentario-comentario_id').value = '0';
		document.getElementById('user').innerHTML = '';
		document.getElementById('texto').innerHTML = '';
		document.getElementById("cita").style.display = "none";
	}
	
	function editar(id, texto, id_cita) {
		no_citar()
		//document.getElementById(id+"_coment").style.display = "none";
		document.getElementById('anuncio_comentario-comentario_id').value = id_cita;
		document.getElementById('anuncio_comentario-texto').value = texto;
		if (id_cita > 0) {
			citar(id_cita, document.getElementById(id+'_cita_name').innerHTML, document.getElementById(id+'_cita_text').innerHTML);
		}
	}
SCRIPT;

$this->registerJs($js1, View::POS_BEGIN);
$this->registerCss($css1, [], '_comentario');
?>

<div class="comentario-mini" id="<?=$model->id?>_coment">

	<p class="user"><strong><?= Usuario::findIdentity($model->crea_usuario_id)->nick ?></strong></p>
	<p class="menor up"><?= $model->crea_fecha ?></p>
	
	<?php if($model->comentario_id != 0) { ?>
		<div class="citado">
			<p class="no-margin-bottom"><strong id="<?=$model->id?>_cita_name"></strong></p>
			<p id="<?=$model->id?>_cita_text"></p>
		</div>
	<?php } ?>
	
	<p class="text"><?= $model->texto ?></p>
	
	<div class="">
		<?= Html::button( '<i class="fas fa-quote-right"></i> Citar', ['class'=>'no-btn menor', 'onclick'=>"citar('".$model->id."', '".$model->crea_usuario_id."', '".$model->texto."');"]); ?>

		<div class="btn-group">
			<button class="dropdown-toggle menor no-btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>
			</button>
			<ul class="dropdown-menu">
				
				<?php 

				if($model->crea_usuario_id == Yii::$app->user->identity->id || Yii::$app->authManager->getRolesByUser(Yii::$app->user->identity->id) == 'Administrador') { 
/////////
					?>
					<li>
						<?= Html::a('Eliminar', ['anuncios_comentarios/delete', 'id' => $model->id], ['data-method' => 'post']) ?> <?php } ?></li>
				<?php if($model->crea_usuario_id != Yii::$app->user->identity->id) { ?>
					<li><?= Html::a('Denunciar', ['denunciar', 'id' => $model->id]) ?><?php } ?></li>
				
			</ul>
		</div>
	</div>
</div>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Zonas;
use app\models\Usuario;
/* @var $this yii\web\View */
/* @var $model app\models\UsuariosAreaModeracion */
/* @var $form yii\widgets\ActiveForm */
$user = Usuario::find()->leftJoin('usuarios_area_moderacion','auth_assignment.user_id=usuarios_area_moderacion.usuario_id')
						->Where(['item_name'=>'usuario']);
$userlista=ArrayHelper::map($user,'id','nick');
$zona = Zonas::find()->all();
$zonalista=ArrayHelper::map($zona,'id','nombre');
?>
<div class="usuarios-area-moderacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'usuario_id')->dropdownList(
			$userlista,
	    	['prompt'=>'Selecciona un usuario']); ?>
    

    <?= $form->field($model, 'zona_id')->dropdownList(
			$zonalista,
	    	['prompt'=>'Selecciona una zona']); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

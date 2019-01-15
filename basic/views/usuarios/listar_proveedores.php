<?php 
use yii\helpers\Html;
use yii\widgets\ListView;
?>
<style>
 li {
  display:inline;
  margin: 1px;
}
</style>


<form >
	<input type="text" name="r" value="usuarios/listar_proveedores" hidden="">
	<input type="text" name="filtro">
	<input type="submit" name="" class="btn-primary" value="Buscar" >

</form>
<?php




echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_usuariosMini',
    'layout' => '<div class="row">{items}</div><div>{pager}{summary}</div>'
]);

?>	
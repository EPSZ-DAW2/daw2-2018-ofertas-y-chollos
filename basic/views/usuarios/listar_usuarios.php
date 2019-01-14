<style>
 li {
  display:inline;
  margin: 1px;
}
</style>

<?php

use yii\widgets\ListView;
use yii\helpers\Html;


echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_usuariosMini',
    'layout' => '<div class="row">{items}</div><div>{pager}{summary}</div>'
]);

?>	
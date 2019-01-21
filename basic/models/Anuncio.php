<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
/**
 * This is the model class for table "{{%anuncios}}".
 *
 * @property string $id
 * @property string $titulo Titulo corto o slogan para el anuncio u oferta.
 * @property string $descripcion Descripción breve del anuncio/oferta o NULL si no es necesaria.
 * @property string $tienda Descripcion de la tienda o lugar del anuncio/oferta o NULL si no se conoce, aunque no debería estar vacío este dato.
 * @property string $url Dirección web externa (opcional) que enlaza con la página "oficial" o directamente del anuncio/oferta o NULL si no hay o no se conoce.
 * @property string $fecha_desde Fecha y Hora de inicio del anuncio/oferta o NULL si no se conoce (mostrar próximamente).
 * @property string $fecha_hasta Fecha y Hora de finalización del anuncio/oferta o NULL si no se conoce (no caduca automaáticamente).
 * @property double $precio_oferta Precio de la oferta.
 * @property double $precio_original Precio original antes de la oferta.
 * @property string $zona_id Area/Zona de ubicación de la tienda del anuncio/oferta o CERO si no existe o aún no está indicada (como si fuera NULL).
 * @property string $categoria_id Categoria de clasificación del anuncio/oferta o CERO si no existe o aún no está indicada (como si fuera NULL).
 * @property string $imagen_id Nombre identificativo (fichero interno) con la imagen principal o "de presentación" del anuncio/oferta, o NULL si no hay.
 * @property int $votosOK Contador de votos a favor para el anuncio/oferta.
 * @property int $votosKO Contador de votos encontra para el anuncio/oferta.
 * @property string $proveedor_id Prveedor  del anuncio/oferta o CERO si no está patrocinado por nadie o no existe, o aún no está indicado (como si fuera NULL).
 * @property int $prioridad Indicador de importancia para el anuncio/oferta en caso de tener proveedor.
 * @property int $visible Indicador de anuncio/oferta visible a los usuarios o invisible (se está manteniendo): 0=Invisible, 1=Visible.
 * @property int $terminada Indicador de anuncio/oferta terminada: 0=No, 1=Realizada, 2=Suspendida, 3=Cancelada por Inadecuada, ...
 * @property string $fecha_terminacion Fecha y Hora de terminación del anuncio/oferta. Debería estar a NULL si no está terminada.
 * @property int $num_denuncias Contador de denuncias del anuncio/oferta o CERO si no ha tenido.
 * @property string $fecha_denuncia1 Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.
 * @property int $bloqueada Indicador de anuncio/oferta bloqueada: 0=No, 1=Si(bloqueada por denuncias), 2=Si(bloqueada por administrador), ...
 * @property string $fecha_bloqueo Fecha y Hora del bloqueo del anuncio/oferta. Debería estar a NULL si no está bloqueada o si se desbloquea.
 * @property string $notas_bloqueo Notas visibles sobre el motivo del bloqueo del anuncio/oferta o NULL si no hay -se muestra por defecto según indique "bloqueada"-.
 * @property int $cerrada_comentar Indicador de anuncio/oferta cerrada para comentarios: 0=No, 1=Si.
 * @property string $crea_usuario_id Usuario que ha creado el anuncio/oferta o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.
 * @property string $crea_fecha Fecha y Hora de creación del anuncio/oferta o NULL si no se conoce por algún motivo.
 * @property string $modi_usuario_id Usuario que ha modificado el anuncio/oferta por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.
 * @property string $modi_fecha Fecha y Hora de la última modificación del anuncio/oferta o NULL si no se conoce por algún motivo.
 * @property string $notas_admin Notas adicionales para los moderadores/administradores sobre el anuncio/oferta o NULL si no hay.
    
 */
class Anuncio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */



    public function rules()
    {
        return [
            [['titulo'], 'required'],
            [['titulo', 'descripcion', 'tienda', 'url', 'notas_bloqueo', 'notas_admin'], 'string'],
            [['fecha_desde', 'fecha_hasta', 'fecha_terminacion', 'fecha_denuncia1', 'fecha_bloqueo', 'crea_fecha', 'modi_fecha'], 'safe'],
            [['precio_oferta', 'precio_original'], 'number'],
            [['zona_id', 'categoria_id', 'votosOK', 'votosKO', 'proveedor_id', 'prioridad', 'num_denuncias', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
            [['imagen_id'], 'string', 'max' => 25],
            [['visible', 'terminada', 'bloqueada', 'cerrada_comentar'], 'string', 'max' => 1],
        ];
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'titulo' => Yii::t('app', 'Titulo corto o slogan para el anuncio u oferta.'),
            'descripcion' => Yii::t('app', 'Descripción breve del anuncio/oferta o NULL si no es necesaria.'),
            'tienda' => Yii::t('app', 'Descripcion de la tienda o lugar del anuncio/oferta o NULL si no se conoce, aunque no debería estar vacío este dato.'),
            'url' => Yii::t('app', 'Dirección web externa (opcional) que enlaza con la página \"oficial\" o directamente del anuncio/oferta o NULL si no hay o no se conoce.'),
            'fecha_desde' => Yii::t('app', 'Fecha y Hora de inicio del anuncio/oferta o NULL si no se conoce (mostrar próximamente).'),
            'fecha_hasta' => Yii::t('app', 'Fecha y Hora de finalización del anuncio/oferta o NULL si no se conoce (no caduca automaáticamente).'),
            'precio_oferta' => Yii::t('app', 'Precio de la oferta.'),
            'precio_original' => Yii::t('app', 'Precio original antes de la oferta.'),
            'zona_id' => Yii::t('app', 'Area/Zona de ubicación de la tienda del anuncio/oferta o CERO si no existe o aún no está indicada (como si fuera NULL).'),
            'categoria_id' => Yii::t('app', 'Categoria de clasificación del anuncio/oferta o CERO si no existe o aún no está indicada (como si fuera NULL).'),
            'imagen_id' => Yii::t('app', 'Nombre identificativo (fichero interno) con la imagen principal o \"de presentación\" del anuncio/oferta, o NULL si no hay.'),
            'votosOK' => Yii::t('app', 'Contador de votos a favor para el anuncio/oferta.'),
            'votosKO' => Yii::t('app', 'Contador de votos encontra para el anuncio/oferta.'),
            'proveedor_id' => Yii::t('app', 'Prveedor  del anuncio/oferta o CERO si no está patrocinado por nadie o no existe, o aún no está indicado (como si fuera NULL).'),
            'prioridad' => Yii::t('app', 'Indicador de importancia para el anuncio/oferta en caso de tener proveedor.'),
            'visible' => Yii::t('app', 'Indicador de anuncio/oferta visible a los usuarios o invisible (se está manteniendo): 0=Invisible, 1=Visible.'),
            'terminada' => Yii::t('app', 'Indicador de anuncio/oferta terminada: 0=No, 1=Realizada, 2=Suspendida, 3=Cancelada por Inadecuada, ...'),
            'fecha_terminacion' => Yii::t('app', 'Fecha y Hora de terminación del anuncio/oferta. Debería estar a NULL si no está terminada.'),
            'num_denuncias' => Yii::t('app', 'Contador de denuncias del anuncio/oferta o CERO si no ha tenido.'),
            'fecha_denuncia1' => Yii::t('app', 'Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.'),
            'bloqueada' => Yii::t('app', 'Indicador de anuncio/oferta bloqueada: 0=No, 1=Si(bloqueada por denuncias), 2=Si(bloqueada por administrador), ...'),
            'fecha_bloqueo' => Yii::t('app', 'Fecha y Hora del bloqueo del anuncio/oferta. Debería estar a NULL si no está bloqueada o si se desbloquea.'),
            'notas_bloqueo' => Yii::t('app', 'Notas visibles sobre el motivo del bloqueo del anuncio/oferta o NULL si no hay -se muestra por defecto según indique \"bloqueada\"-.'),
            'cerrada_comentar' => Yii::t('app', 'Indicador de anuncio/oferta cerrada para comentarios: 0=No, 1=Si.'),
            'crea_usuario_id' => Yii::t('app', 'Usuario que ha creado el anuncio/oferta o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.'),
            'crea_fecha' => Yii::t('app', 'Fecha y Hora de creación del anuncio/oferta o NULL si no se conoce por algún motivo.'),
            'modi_usuario_id' => Yii::t('app', 'Usuario que ha modificado el anuncio/oferta por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.'),
            'modi_fecha' => Yii::t('app', 'Fecha y Hora de la última modificación del anuncio/oferta o NULL si no se conoce por algún motivo.'),
            'notas_admin' => Yii::t('app', 'Notas adicionales para los moderadores/administradores sobre el anuncio/oferta o NULL si no hay.'),
        ];
    }



    /**
     * @inheritdoc
     * @return AnunciosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AnunciosQuery(get_called_class());
    }

      public static function maximoDenuncias(){
        return 10;
    }

    public static function tableName()
    {
        return '{{%anuncios}}';
    }



    //Administración de las listas de bloqueo
    protected static $bloqueos=array( 0=>'No', 1=>'Bloqueado por denuncias', 2=>'Bloqueada por administrador');

    public static function listarBloqueos(){
        return self::$bloqueos;
    }

    //Administración de las listas de terminación
    protected static $terminaciones=array( 0=>'No', 1=>'Realizada', 2=>'Suspendida', 3=>'Cancelada por inadecuada');

    public static function listarTerminaciones(){
        return self::$terminaciones;
}


}


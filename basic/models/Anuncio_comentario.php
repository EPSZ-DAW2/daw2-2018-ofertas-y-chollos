<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%anuncios_comentarios}}".
 *
 * @property string $id
 * @property string $anuncio_id Anuncio/Oferta relacionada
 * @property string $texto El texto del comentario.
 * @property string $comentario_id Comentario relacionado, si se permiten encadenar respuestas. Nodo padre de la jerarquia de comentarios, CERO si es nodo raiz.
 * @property int $cerrado Indicador de cierre de los comentarios: 0=No, 1=Si(No se puede responder al comentario)
 * @property int $num_denuncias Contador de denuncias del comentario o CERO si no ha tenido.
 * @property string $fecha_denuncia1 Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.
 * @property int $bloqueado Indicador de comentario bloqueado: 0=No, 1=Si(bloqueado por denuncias), 2=Si(bloqueado por administrador), ...
 * @property string $fecha_bloqueo Fecha y Hora del bloqueo del comentario. Debería estar a NULL si no está bloqueado o si se desbloquea.
 * @property string $notas_bloqueo Notas visibles sobre el motivo del bloqueo del comentario o NULL si no hay -se muestra por defecto según indique "bloqueado"-.
 * @property string $crea_usuario_id Usuario que ha creado el comentario o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.
 * @property string $crea_fecha Fecha y Hora de creación del comentario o NULL si no se conoce por algún motivo.
 * @property string $modi_usuario_id Usuario que ha modificado el comentario por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.
 * @property string $modi_fecha Fecha y Hora de la última modificación del comentario o NULL si no se conoce por algún motivo.
 */
class Anuncio_comentario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%anuncios_comentarios}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['anuncio_id', 'texto'], 'required'],
            [['anuncio_id', 'comentario_id', 'num_denuncias', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
            [['texto', 'notas_bloqueo'], 'string'],
            [['fecha_denuncia1', 'fecha_bloqueo', 'crea_fecha', 'modi_fecha'], 'safe'],
            [['cerrado', 'bloqueado'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'anuncio_id' => Yii::t('app', 'ID Anuncio'),
            'texto' => Yii::t('app', 'Texto'),
            'comentario_id' => Yii::t('app', 'ID Comentario Padre'),
            'cerrado' => Yii::t('app', 'Cerrado'),
            'num_denuncias' => Yii::t('app', 'Nº Denuncias'),
            'fecha_denuncia1' => Yii::t('app', 'Fecha 1ª Denuncia'),
            'bloqueado' => Yii::t('app', 'Bloqueado'),
            'fecha_bloqueo' => Yii::t('app', 'Fecha bloqueo'),
            'notas_bloqueo' => Yii::t('app', 'Nota bloqueo'),
            'crea_usuario_id' => Yii::t('app', 'ID Usuario Creador'),
            'crea_fecha' => Yii::t('app', 'Fecha creación'),
            'modi_usuario_id' => Yii::t('app', 'ID Usuario Modificador'),
            'modi_fecha' => Yii::t('app', 'Fecha modificación'),
            'id_y_usuario' => Yii::t('app', 'Usuario'),
            'id_y_anuncio' => Yii::t('app', 'Anuncio'),
        ];
    }

    /**
     * @inheritdoc
     * @return Anuncios_comentariosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new Anuncios_comentariosQuery(get_called_class());
    }
		
	//-------------------------------------------------------------------------
	//lista de estados posibles para bloqueo.
	public static $bloqueados= array(
		0=>'No', 
		1=>'Bloqueado por denuncias',
		2=>'Bloqueado por administrador',
	);
		
	public function getBloqueado()
    {
		return $this::$bloqueados[$this->bloqueado];
    }
	
	public static $cerrados= array(
		0=>'No', 
		1=>'Si',
	);
		
	public function getCerrado()
    {
		return $this::$cerrados[$this->cerrado];
    }
	
	public function getAnuncio()
    {
        $titulo=Anuncio::find()->select('titulo')->where(['id'=>$this->anuncio_id])->one();
        return $titulo->titulo;
    }
		
	public function getUsuario()
    {
        $nick=Usuario::find()->select('nick')->where(['id'=>$this->crea_usuario_id])->one();
        return $nick->nick;
    }
		
	public function getId_y_anuncio()
    {
        return '['.$this->anuncio_id.'] → '.$this->anuncio;
    }
		
	public function getId_y_usuario()
    {
        return '['.$this->crea_usuario_id.'] → '.$this->usuario;
    }
		
		
}

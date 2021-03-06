<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios_avisos".
 *
 * @property string $id
 * @property string $fecha_aviso Fecha y Hora de creación del aviso.
 * @property string $clase_aviso_id código de clase de aviso: A=Aviso, N=Notificación, D=Denuncia, C=Consulta, B=Bloqueo, M=Mensaje Genérico,...
 * @property string $texto Texto con el mensaje de aviso.
 * @property string $destino_usuario_id Usuario relacionado, destinatario del aviso, o NULL si no es para administración y aún no está gestionado.
 * @property string $origen_usuario_id Usuario relacionado, origen del aviso, o NULL si es del sistema.
 * @property string $anuncio_id Anuncio/Oferta relacionada o NULL si no tiene que ver directamente.
 * @property string $comentario_id Comentario relacionado o NULL si no tiene que ver directamente con un comentario.
 * @property string $fecha_lectura Fecha y Hora de lectura del aviso o NULL si no se ha leido o se ha desmarcado como tal.
 * @property string $fecha_aceptado Fecha y Hora de aceptación del aviso o NULL si no se ha aceptado para su gestión por un moderador o administrador. No se usa en otros usuarios.
 */
class UsuariosAviso extends \yii\db\ActiveRecord
{
    public $zona_busqueda;
    public $fecha_limpieza;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios_avisos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_aviso'], 'required'],
            [['fecha_aviso', 'fecha_lectura', 'fecha_aceptado'], 'safe'],
            [['texto'], 'string'],
            [['destino_usuario_id', 'origen_usuario_id', 'anuncio_id', 'comentario_id'], 'integer'],
            [['clase_aviso_id'], 'string', 'max' => 1],
        ];
    }


    protected static $tipos=[ 'A'=>'Aviso', 'N'=>'Notificación', 'D'=>'Denuncia', 'C'=>'Consulta', 'M'=>'Mensaje', 'B'=>'Bloqueo'];

    public static function getListaTipos()
    {
        return self::$tipos;
    }

    public static function nombreTipo($id)
    {
        return isset(self::$tipos[$id]) ? self::$tipos[$id] : null;
    }

    public function getTipo()
    {

        return self::nombreTipo($this->clase_aviso_id);
    }
    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fecha_aviso' => Yii::t('app', 'Fecha Aviso'),
            'clase_aviso_id' => Yii::t('app', 'Clase de aviso'),
            'texto' => Yii::t('app', 'Texto'),
            'destino_usuario_id' => Yii::t('app', 'Usuario de destino'),
            'origen_usuario_id' => Yii::t('app', 'Usuario de origen'),
            'anuncio_id' => Yii::t('app', 'Anuncio'),
            'anuncio' => Yii::t('app', 'Titulo del Anuncio'),
            'comentario_id' => Yii::t('app', 'Comentario'),
            'fecha_lectura' => Yii::t('app', 'Fecha Lectura'),
            'fecha_aceptado' => Yii::t('app', 'Fecha Aceptación'),
            'tipo' => Yii::t('app', 'Tipo'),
            'usuarioDestino' => Yii::t('app', 'Destinatario'),
            'usuarioOrigen' => Yii::t('app', 'Remitente'),
        ];
    }

    public function getUsuarioDestino()
    {
        $nick=Usuario::find()->select('nick')->where(['id'=>$this->destino_usuario_id])->one();
        if(isset($nick->nick))
        {
            return $nick->nick;
        }
        else
        {
            return null;
        }
    }

    public function getUsuarioOrigen()
    {
        $nick=Usuario::find()->select('nick')->where(['id'=>$this->origen_usuario_id])->one();
        if(isset($nick->nick))
        {
            return $nick->nick;
        }
        else
        {
            return null;
        }
    }

    public function getAvisosClientesOrigen()
    {
        return $this->hasOne(Usuario::className(),['id'=>'origen_usuario_id']);
    }

    public function getAvisosClientesDestino()
    {
        return $this->hasOne(Usuario::className(),['id'=>'destino_usuario_id']);
    }

    public function getAvisosAnuncio()
    {
        return $this->hasOne(Anuncio::className(),['id'=>'anuncio_id']);
    }

    public function getAnuncio()
    {
        $titulo=Anuncio::find()->select('titulo')->where(['id'=>$this->anuncio_id])->one();
        if(isset($titulo->titulo))
        {
            return $titulo->titulo;
        }
        else
        {
            return null;
        }
    }

    public function getAvisosModeracion()
    {
        //obtenemos ids de usuarios en la zona
        $avisos=array(-1);
        $ids=array();
        $id_usuarios=Usuario::find()->select('id')->where(['zona_id'=>$this->zona_busqueda])->all();
        foreach ($id_usuarios as $aux)
        {
            $ids[]=$aux->id;
        }
        //obtenemos avisos con los ids de los usuarios
        $aux=UsuariosAviso::find()->where(['origen_usuario_id'=>$ids])->all();
        foreach ($aux as $aviso)
        {
            $avisos[$aviso->id]=$aviso->id;
        }

        //obtenemos avisos con los ids de los usuarios
        $aux=UsuariosAviso::find()->where(['destino_usuario_id'=>$ids])->all();
        foreach ($aux as $aviso)
        {
            $avisos[$aviso->id]=$aviso->id;
        }

        //obtenemos ids de anuncios en la zona
        $ids=array();
        $id_anuncios=Anuncio::find()->select('id')->where(['zona_id'=>$this->zona_busqueda])->all();
        foreach ($id_anuncios as $aux)
        {
            $ids[]=$aux->id;
        }
        //obtenemos avisos con los ids de los anuncios
        $aux=UsuariosAviso::find()->where(['anuncio_id'=>$ids])->all();
        foreach ($aux as $aviso)
        {
            $avisos[$aviso->id]=$aviso->id;
        }

        //obtenemos ids de comentarios en la zona
        $id_comentarios=Anuncio_comentario::find()->select('id')->where(['anuncio_id'=>$ids])->all();
        $ids=array();
        foreach ($id_comentarios as $aux)
        {
            $ids[]=$aux->id;
        }
        //obtenemos avisos con los ids de los anuncios
        $aux=UsuariosAviso::find()->where(['comentario_id'=>$ids])->all();
        foreach ($aux as $aviso)
        {
            $avisos[$aviso->id]=$aviso->id;
        }

        return $avisos;
    }

    /*public function getZonaUsuarioOrigen()
    {
        $zona=Usuario::find()->select('zona_id')->where(['id'=>$this->origen_usuario_id])->one();
        return $zona->zona_id;
    }


    public function getZonaUsuarioDestino()
    {
        $zona=Usuario::find()->select('zona_id')->where(['id'=>$this->destino_usuario_id])->one();
        return $zona->zona_id;
    }

    public function getZonaAnuncio()
    {
        $zona=Anuncio::find()->select('zona_id')->where(['id'=>$this->anuncio_id])->one();
        return $zona->zona_id;
    }

    public function getZonaComentario()
    {
        $anuncio=Anuncio_comentario::find()->select('anuncio_id')->where(['id'=>$this->comentario_id])->one();
        $zona=Anuncio::find()->select('zona_id')->where(['id'=>$anuncio->anuncio_id])->one();
        return $zona->zona_id;
    }*/

    /**
     * @inheritdoc
     * @return UsuariosAvisosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuariosAvisosQuery(get_called_class());
    }
}

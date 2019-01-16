<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property string $id
 * @property string $email Correo Electronico y "login" del usuario.
 * @property string $password
 * @property string $nick
 * @property string $nombre
 * @property string $apellidos
 * @property string $fecha_nacimiento Fecha de nacimiento del usuario o NULL si no lo quiere informar.
 * @property string $direccion Direccion del usuario o NULL si no quiere informar.
 * @property string $zona_id Area/Zona de localización del usuario o CERO si no lo quiere informar (como si fuera NULL), aunque es recomendable.
 * @property string $fecha_registro Fecha y Hora de registro del usuario o NULL si no se conoce por algún motivo (que no debería ser).
 * @property int $confirmado Indicador de usuario ha confirmado su registro o no.
 * @property string $fecha_acceso Fecha y Hora del ultimo acceso del usuario. Debería estar a NULL si no ha accedido nunca.
 * @property int $num_accesos Contador de accesos fallidos del usuario o CERO si no ha tenido o se ha reiniciado por un acceso valido o por un administrador.
 * @property int $bloqueado Indicador de usuario bloqueado: 0=No, 1=Si(bloqueada por accesos), 2=Si(bloqueada por administrador), ...
 * @property string $fecha_bloqueo Fecha y Hora del bloqueo del usuario. Debería estar a NULL si no está bloqueado o si se desbloquea.
 * @property string $notas_bloqueo Notas visibles sobre el motivo del bloqueo del usuario o NULL si no hay -se muestra por defecto según indique "bloqueado"-.
 */
class Perfil extends \yii\db\ActiveRecord
{
    public $anpassword;
    public $password2;
    public $password3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', /*'password2', 'password3',*/ 'nick', 'nombre', 'apellidos', 'confirmado'], 'required'],
            [['fecha_nacimiento', 'fecha_registro', 'fecha_acceso', 'fecha_bloqueo'], 'safe'],
            [['direccion', 'notas_bloqueo'], 'string'],
            [['zona_id', 'num_accesos'], 'integer'],
            [['email'], 'string', 'max' => 255],
            [['password3'], 'string', 'max' => 60],
            [['anpassword'], 'string', 'max' => 60],
            [['password2'], 'string', 'max' => 60],
            [['password2'], 'compare','compareAttribute'=>'password3'],
            [['nick'], 'string', 'max' => 25],
            [['nombre'], 'string', 'max' => 50],
            [['apellidos'], 'string', 'max' => 100],
            [['confirmado', 'bloqueado'], 'string', 'max' => 1],
            [['email'], 'unique'],
            [['nick'], 'unique'],
        ];
    }
    public function funcion($variable){
        return md5($variable);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Correo Electronico.'),
            'anpassword' => Yii::t('app', 'Contraseña antigua'),
            'password3' => Yii::t('app', 'Contraseña'),
            'password2' => Yii::t('app', 'Repita su Contraseña'),
            'nick' => Yii::t('app', 'Nick'),
            'nombre' => Yii::t('app', 'Nombre'),
            'apellidos' => Yii::t('app', 'Apellidos'),
            'fecha_nacimiento' => Yii::t('app', 'Fecha de nacimiento.'),
            'direccion' => Yii::t('app', 'Direccion del usuario.'),
            'zona_id' => Yii::t('app', 'Area/Zona de localización del usuario'),
            'fecha_registro' => Yii::t('app', 'Fecha y Hora de registro del usuario o NULL si no se conoce por algún motivo (que no debería ser).'),
            'confirmado' => Yii::t('app', 'Indicador de usuario ha confirmado su registro o no.'),
            'fecha_acceso' => Yii::t('app', 'Fecha y Hora del ultimo acceso del usuario. Debería estar a NULL si no ha accedido nunca.'),
            'num_accesos' => Yii::t('app', 'Contador de accesos fallidos del usuario o CERO si no ha tenido o se ha reiniciado por un acceso valido o por un administrador.'),
            'bloqueado' => Yii::t('app', 'Indicador de usuario bloqueado: 0=No, 1=Si(bloqueada por accesos), 2=Si(bloqueada por administrador), ...'),
            'fecha_bloqueo' => Yii::t('app', 'Fecha y Hora del bloqueo del usuario. Debería estar a NULL si no está bloqueado o si se desbloquea.'),
            'notas_bloqueo' => Yii::t('app', 'Notas visibles sobre el motivo del bloqueo del usuario o NULL si no hay -se muestra por defecto según indique \"bloqueado\"-.'),
        ];
    }

    /**
     * @inheritdoc
     * @return UsuariosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuariosQuery(get_called_class());
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mensajes".
 *
 * @property string $id
 * @property string $fecha_hora Fecha y Hora de creación del mensaje.
 * @property string $texto Texto con el mensaje.
 * @property string $origen_usuario_id Usuario relacionado, origen del mensaje.
 * @property string $destino_usuario_id Usuario relacionado, destinatario del mensaje.
 */
class Mensaje extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mensajes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_hora'], 'required'],
            [['fecha_hora'], 'safe'],
            [['texto'], 'string'],
            [['origen_usuario_id', 'destino_usuario_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fecha_hora' => Yii::t('app', 'Fecha y Hora de creación del mensaje.'),
            'texto' => Yii::t('app', 'Texto con el mensaje.'),
            'origen_usuario_id' => Yii::t('app', 'Usuario relacionado, origen del mensaje.'),
            'destino_usuario_id' => Yii::t('app', 'Usuario relacionado, destinatario del mensaje.'),
        ];
    }

    public function getMensajes()
    {
        return $mensajes=Mensaje::find()->where(['and',['origen_usuario_id'=>$this->destino_usuario_id],['destino_usuario_id'=>$this->origen_usuario_id]])->all();
    }

    public function getNick()
    {
        $nick=Usuario::find()->select('nick')->where(['id'=>$this->origen_usuario_id])->one();
        return $nick->nick;
    }

    public function getNo_leidos()
    {
        return $mensajes=Mensaje::find()->where(['destino_usuario_id'=>$this->destino_usuario_id])->all();
    }

    public function getLista()
    {
        $nicks=array();
        if(!empty($_SESSION['mensajes']))
        {
            foreach($_SESSION['mensajes'] as $key=>$mensaje)
            {
                $nicks[$key]=$mensaje[0]->nick;
            }
        }
        $mensajes=$this->no_leidos;
        foreach($mensajes as $mensaje)
        {
            $id=$mensaje->origen_usuario_id;
            if(!isset($_SESSION['mensajes'][$id]))
            {
                $nicks[$id]=$mensaje->nick;
            }
        }
        return $nicks;
    }

    /**
     * @inheritdoc
     * @return MensajesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MensajesQuery(get_called_class());
    }
}

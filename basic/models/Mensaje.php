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

    /**
     * @inheritdoc
     * @return MensajesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MensajesQuery(get_called_class());
    }
}

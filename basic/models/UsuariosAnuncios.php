<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios_anuncios".
 *
 * @property string $id
 * @property string $usuario_id Usuario relacionado, seguidor del anuncio/oferta.
 * @property string $anuncio_id Anuncio/Oferta relacionada.
 * @property string $fecha_seguimiento Fecha y Hora de activación del seguimiento del anuncio/oferta por parte del usuario.
 */
class UsuariosAnuncios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios_anuncios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'anuncio_id', 'fecha_seguimiento'], 'required'],
            [['usuario_id', 'anuncio_id'], 'integer'],
            [['fecha_seguimiento'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario relacionado, seguidor del anuncio/oferta.',
            'anuncio_id' => 'Anuncio/Oferta relacionada.',
            'fecha_seguimiento' => 'Fecha y Hora de activación del seguimiento del anuncio/oferta por parte del usuario.',
        ];
    }

    /**
     * {@inheritdoc}
     * @return UsuariosAnunciosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuariosAnunciosQuery(get_called_class());
    }
}

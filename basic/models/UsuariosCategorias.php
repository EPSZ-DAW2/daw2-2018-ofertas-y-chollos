<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%usuarios_categorias}}".
 *
 * @property string $id
 * @property string $usuario_id Usuario relacionado.
 * @property string $categoria_id Categoria relacionada.
 * @property string $fecha_seguimiento Fecha y Hora de activación del seguimiento de la categoria por parte del usuario.
 */
class UsuariosCategorias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%usuarios_categorias}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'categoria_id', 'fecha_seguimiento'], 'required'],
            [['usuario_id', 'categoria_id'], 'integer'],
            [['fecha_seguimiento'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'usuario_id' => Yii::t('app', 'Usuario relacionado.'),
            'categoria_id' => Yii::t('app', 'Categoria relacionada.'),
            'fecha_seguimiento' => Yii::t('app', 'Fecha y Hora de activación del seguimiento de la categoria por parte del usuario.'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UsuariosCategoriasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuariosCategoriasQuery(get_called_class());
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%etiquetas}}".
 *
 * @property string $id
 * @property string $nombre
 * @property string $descripcion Texto adicional que describe la etiqueta o NULL si no es necesario.
 */
class Etiqueta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%etiquetas}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['nombre'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
        ];
    }

    /**
     * @inheritdoc
     * @return EtiquetasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EtiquetasQuery(get_called_class());
    }
}

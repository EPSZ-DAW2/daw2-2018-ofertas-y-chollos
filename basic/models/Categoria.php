<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%categorias}}".
 *
 * @property string $id
 * @property string $nombre
 * @property string $descripcion Texto adicional que describe la categoria o clasificación.
 * @property string $icono Nombre del icono relacionado de entre los disponibles en la aplicación (carpeta iconos posibles).
 * @property string $categoria_id Categoria relacionada, para poder realizar la jerarquía de clasificaciones. Nodo padre de la jerarquía de categoría, o CERO si es nodo raiz (como si fuera NULL).
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%categorias}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['categoria_id'], 'integer'],
            [['nombre', 'icono'], 'string', 'max' => 25],
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
            'icono' => Yii::t('app', 'Icono'),
            'categoria_id' => Yii::t('app', 'Categoria ID'),
        ];
    }

    /**
     * @inheritdoc
     * @return CategoriasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoriasQuery(get_called_class());
    }
}

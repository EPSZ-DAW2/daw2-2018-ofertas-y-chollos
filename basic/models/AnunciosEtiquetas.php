<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%anuncios_etiquetas}}".
 *
 * @property string $id
 * @property string $anuncio_id Anuncio/oferta relacionada
 * @property string $etiqueta_id Etiqueta relacionada.
 */
class AnunciosEtiquetas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%anuncios_etiquetas}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anuncio_id', 'etiqueta_id'], 'required'],
            [['anuncio_id', 'etiqueta_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'anuncio_id' => Yii::t('app', 'Anuncio/oferta relacionada'),
            'etiqueta_id' => Yii::t('app', 'Etiqueta relacionada.'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return AnunciosEtiquetasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AnunciosEtiquetasQuery(get_called_class());
    }
}

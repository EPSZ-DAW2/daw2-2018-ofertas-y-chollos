<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "Zonas".
 *
 * @property string $id
 * @property string $clase_zona_id Código de clase de la zona: 1=Continente, 2=Pais, 3=Estado, 4=Region, 5=Provincia, 6=Municipio, 7=Localidad, 8=Barrio, 9=Area, ...
 * @property string $nombre Nombre de la zona que la identifica.
 * @property string $zona_id Zona relacionada. Nodo padre de la jerarquia o CERO si es nodo raiz.
 */
class Zonas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Zonas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clase_zona_id', 'nombre'], 'required'],
            [['zona_id'], 'default', 'value' => 0],
            [['clase_zona_id'], 'string', 'max' => 1],
            [['nombre'], 'string', 'max' => 50],
        ];
    }
public static $zonas=[ 1=>'Continente', 2=>'Pais', 3=>'Estado', 4=>'Region', 5=>'Provincia', 6=>'Municipio', 7=>'Localidad', 8=>'Barrio', 9=>'Area'];


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'clase_zona_id' => Yii::t('app','Código de clase de la zona'),
            'nombre' => Yii::t('app','Nombre de la zona que la identifica.'),
            'zona_id' => Yii::t('app','Zona relacionada.'),
            'zonaPadre' => Yii::t('app','Zona relacionada.'),
            'claseZona'=>Yii::t('app','Tipo de zona'),
        ];
    }
    public function getPadreZona()
    {
        return $this->hasOne(Zonas::className(), ['id' => 'zona_id']);
    }

    public function getZonaPadre(){
        $padre = $this->padreZona;
        if ($padre) return $padre->nombre;
    }


    public function getClaseZona(){
        return $this::$zonas[$this->clase_zona_id];
    }
    //////////PARA FILTRAR Y BUSCAR
    public function getPadreOrdenar(){
        return $this->hasOne(Zonas::className(), ['id' => 'zona_id']);
    }
}

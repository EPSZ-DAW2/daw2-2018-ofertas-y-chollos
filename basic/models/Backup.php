<?php

class Backup extends CFormModel
{
	public $fichero_subir;
	
	
	
	public function rules()
	{
		if(!isset($this->scenario))
			$this->scenario = 'upload';

		return array(
			array('upload_file', 'required'),
		);
	}
	
	public function attributeLabels()
	{
		return array(
			'upload_file'=>'Upload File',
		);
	}
	public static function label($n = 1) {
		return Yii::t('app', 'File|Files', $n);
	}
}
?>
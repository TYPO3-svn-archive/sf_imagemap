<?php

class tx_sfimagemap_controlls {
	protected $table;
	protected $row;
	protected $conf;
	
	protected $imageField;
	protected $widthField;
	protected $heightField;
	
	public function __construct() {
	}
	
	private function init($PA, $fObj) {
		$this->table = $PA['table'];
		$this->row = $PA['row'];
		$this->conf = $PA['fieldConf']['config'];
		$this->widthField = $PA['fieldConf']['config']['widthField'];
		$this->heightField = $PA['fieldConf']['config']['heightField'];
	}
	
	public function getSingleField_typePreview($PA, $fObj) {
		$this->init($PA, $fObj);
		
		$imgPath = $GLOBALS['TCA'][$this->table]['columns'][$this->conf['imageField']]['config']['uploadfolder'] .'/';
		$imgs = $fObj->extractValuesOnlyFromValueLabelList($this->row[$this->conf['imageField']]);
		
		if (isset($this->row[$this->conf['widthField']]) && $this->row[$this->conf['widthField']] > 0) {
			$maxW = $this->row[$this->conf['widthField']]; 
		} else {
			$maxW = 100;
		}
		if (isset($this->row[$this->conf['heightField']]) && $this->row[$this->conf['heightField']] > 0) {
			$maxH = $this->row[$this->conf['heightField']]; 
		} else {
			$maxH = 100;
		}

		$imgObj = t3lib_div::makeInstance('t3lib_stdGraphic');
		$imgObj->init();
		$imgObj->mayScaleUp = 0;
		$imgObj->tempPath = PATH_site . $imgObj->tempPath;
		
		$images = array();
		foreach ($imgs as $imgKey => $imgVal) {
			$tempImg = $imgObj->imageMagickConvert(PATH_site . $imgPath . $imgVal,
				'jpg',
				$maxW . 'm',
				$maxH . 'm',
				'',
				'',
				'',
				1);
			if($tempImg[3] != '') {
				$images[] = '<img src="'. t3lib_div::resolveBackPath($GLOBALS['BACK_PATH'] . '../' . substr($tempImg[3], strlen(PATH_site))) .'"/>';
			}
		}
;
		return implode('', $images);
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sf_imagemap/lib/class.tx_sfimagemap_controlls.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sf_imagemap/lib/class.tx_sfimagemap_controlls.php']);
}

?>
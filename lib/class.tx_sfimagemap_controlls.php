<?php

class tx_sfimagemap_controlls {
	protected $table;
	protected $row;
	protected $field;
	
	public function __construct() {
	}
	
	private function init($PA, $fObj) {
		$this->table = $PA['table'];
		$this->row = $PA['row'];
		$this->field = $PA['fieldConf']['config']['field'];
	}
	
	public function getSingleField_typePreview($PA, $fObj) {
		$this->init($PA, $fObj);
		
		$imgPath = $GLOBALS['TCA'][$this->table]['columns'][$this->field]['config']['uploadfolder'] .'/';
		$imgs = $fObj->extractValuesOnlyFromValueLabelList($this->row[$this->field]);
		$maxW = isset($PA['fieldConf']['config']['maxW']) ? $PA['fieldConf']['config']['maxW'] : 100;
		$maxH = isset($PA['fieldConf']['config']['maxH']) ? $PA['fieldConf']['config']['maxH'] : 100;
		
		$imgObj = t3lib_div::makeInstance('t3lib_stdGraphic');
		$imgObj->init();
		$imgObj->mayScaleUp = 0;
		$imgObj->tempPath = PATH_site . $imgObj->tempPath;
		
		$images = array();
		foreach ($imgs as $imgKey => $imgVal) {
<<<<<<< .mine
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
=======
			$conf = array();
			
			$conf['image.']['file'] = $imgVal;
			$conf['image.']['file.']['import.'] = $imgPath;
			$conf['image.']['altText'] = $imgVal;
			$conf['image.']['titleText'] = $imgVal;
			
			if (isset($PA['fieldConf']['config']['maxW'])) {
				$conf['image.']['file.']['maxW'] = $PA['fieldConf']['config']['maxW'];
>>>>>>> .r336
			}
<<<<<<< .mine
=======
			if (isset($PA['fieldConf']['config']['maxH'])) {
				$conf['image.']['file.']['maxH'] = $PA['fieldConf']['config']['maxH'];
			}

			$images[] = $this->cObj->IMG_RESOURCE($conf['image.']);
			if ($images[$errorcount] == '') {
				$images[] = $this->cObj->TEXT(array('value' => $conf['image.']['file'], 'wrap' => '<b>|</b>'));
				$errorcount++;
			}
>>>>>>> .r336
		}
<<<<<<< .mine

		return implode('', $images);
=======
		
		return implode('<br/>', $images);
>>>>>>> .r336
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sf_imagemap/lib/class.tx_sfimagemap_controlls.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sf_imagemap/lib/class.tx_sfimagemap_controlls.php']);
}

?>
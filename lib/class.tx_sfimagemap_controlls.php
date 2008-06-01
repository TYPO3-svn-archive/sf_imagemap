<?php

class tx_sfimagemap_controlls {
	protected $cObj;
	
	protected $table;
	protected $row;
	protected $field;
	
	public function __construct() {
	}
	
	private function init($PA, $fObj) {
		$this->table = $PA['table'];
		$this->row = $PA['row'];
		$this->field = $PA['fieldConf']['config']['field'];
		
		$this->cObj = $this->createCObj($this->row['pid']);
	}
	
	public function getSingleField_typePreview($PA, $fObj) {
		$this->init($PA, $fObj);
		
		$imgPath = $GLOBALS['TCA'][$this->table]['columns'][$this->field]['config']['uploadfolder'] .'/';
		$imgs = $fObj->extractValuesOnlyFromValueLabelList($this->row[$this->field]);

		$images = array();
		foreach ($imgs as $imgKey => $imgVal) {
			$conf = array();
			
			$conf['file'] = $imgPath . $imgVal;
			$conf['altText'] = $imgVal;
			$conf['titleText'] = $imgVal;
			
			if (isset($PA['fieldConf']['config']['maxW'])) {
				$conf['file.']['maxW'] = $PA['fieldConf']['config']['maxW'];
			}
			if (isset($PA['fieldConf']['config']['maxH'])) {
				$conf['file.']['maxH'] = $PA['fieldConf']['config']['maxH'];
			}

			$images[] = $this->cObj->IMAGE(array('file' => $imgPath . $imgVal));
			$images[] = $this->cObj->TEXT(array('value' => $conf['file']));
		}
		$images[] = $this->cObj->IMAGE(array('file' => '../../../../uploads/tx_sfimagemap/Nova_Orbis_Tabula_in_Lucem_Edita.jpg'));

		return implode('', $images);
	}
	
	protected function createCObj($pid = 1){
		require_once(PATH_site . 'typo3/sysext/cms/tslib/class.tslib_fe.php');
		require_once(PATH_site . 'typo3/sysext/cms/tslib/class.tslib_feuserauth.php');
		require_once(PATH_site . 'typo3/sysext/cms/tslib/class.tslib_content.php') ;

			// Finds the TSFE classname
		$TSFEclassName = t3lib_div::makeInstanceClassName('tslib_fe');
 
			// Create the TSFE class.
		$GLOBALS['TSFE'] = new $TSFEclassName($GLOBALS['TYPO3_CONF_VARS'], $pid, '0', 0, '', '', '', '');

		$GLOBALS['TSFE']->initFEuser();
 
		$GLOBALS['TSFE']->initTemplate();

		$cObj = t3lib_div::makeInstance('tslib_cObj');
		return $cObj;
	}
	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sf_imagemap/lib/class.tx_sfimagemap_controlls.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sf_imagemap/lib/class.tx_sfimagemap_controlls.php']);
}

?>
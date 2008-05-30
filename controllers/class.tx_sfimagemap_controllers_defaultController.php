<?php

class tx_sfimagemap_controllers_defaultController {

	protected $someVar = array();
	
	
	public function __construct() {
		$a = array();
		$a['item1'] = 'inhalt';
		
		$b = array(
			'var',
			'var2',
		);
		
		if ($long ||
				$long ||
				$long) {
			$d;
		} elseif ($somecondition) {	
		} else {
			$d;
		}
		
		switch ($a) {
			case 1:
				$dfghdfkg;
				break;
			case 2:
				$dggdg;
			// intentionaly no break
			case 3:
				break;
			default:
		}
		
		foreach ($aarray as $akey => $avalue) {
		
		}
		$args = array();
		$this->someMethod($a, $args);
	}
	
	/**
	 * Function does bla...
	 *
	 * @param tx_div	bla blubb
	 * @param array		other bla
	 * @return string
	 * @access public
	 */
	public function someMethod(tx_div $divObject, array $configuration = array()) {
		$GLOBALS[];
		
		$a = 'asdf';
		$a .= 'afg';
		
		$b = false;
		$c = true;
		
		return $a;
	}
	
	// ein maximal 80 Zeichen langer Kommentar der auch für Code als Länge gilt
	protected function someFunction() {
		$result = '';
		
		if ($case) {
			$result = 'text';	
		}
		
		$result = (false ? 'true' : 'else');
		
		return $result;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sf_imagemap/controllers/class.tx_sfimagemap_controllers_defaultController.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sf_imagemap/controllers/class.tx_sfimagemap_controllers_defaultController.php']);
}

?>
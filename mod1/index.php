<?php

unset($MCONF);
require ('conf.php');
require ($BACK_PATH . 'init.php');
require ($BACK_PATH . 'template.php');

$LANG->includeLLFile('EXT:sf_imagemap/mod1/locallang.xml');
require_once (PATH_t3lib . 'class.t3lib_scbase.php');
$BE_USER->modAccess($MCONF, 1);	// This checks permissions and exits if the users has no permission for entry.

class tx_sfimagemap_module1 extends t3lib_SCbase {
	private $conf = array();
	public $content = '';
	private $actionQuee = array('init');
	
	private $backPath;
	private $beUser;
	private $client;
	private $lang;
	private $tca;
	private $tcaDescr;
	private $typo3ConfVars;

	/**
	 * Initialisation of this backend module
	 *
	 * @return	void
	 * @access	public
	 */
	public function initAction() {
		$this->backPath = $GLOBALS['BACK_PATH'];
		$this->beUser =& $GLOBALS['BE_USER'];
		$this->client =& $GLOBALS['CLIENT'];
		$this->lang =& $GLOBALS['LANG'];
		$this->tca =& $GLOBALS['TCA'];
		$this->tcaDescr =& $GLOBALS['TCA_DESCR'];
		$this->typo3ConfVars =& $GLOBALS['TYPO3_CONF_VARS'];

		parent::init();

		$this->appendAction('prepareDocument');
		
		if (!$this->getAccessRights()) {
			$this->appendAction('noAccess');
		} else {
			$this->appendAction('createContent');
		}
	}
	
	/**
	 * Main function of the module.
	 *
	 * @return	void
	 * @access	public
	 */
	public function main() {
		do {
			$action = $this->getAction() . 'Action';
			call_user_func(array('tx_sfimagemap_module1', $action));
		} while(next($this->actionQuee) != null);

		$docHeaderButtons = $this->getButtons();
		$markers = array(
			'CSH' => $docHeaderButtons['csh'],
			'FUNC_MENU' => $this->getFuncMenu(),
			'CONTENT' => $this->content,
			'SAVE' => '',
		);
		// Build the <body> for the module
		$this->content = $this->doc->startPage($this->getLL('title'));
		$this->content.= $this->doc->moduleBody($this->pageinfo, $docHeaderButtons, $markers);
		$this->content.= $this->doc->endPage();
		$this->content = $this->doc->insertStylesAndJS($this->content);
		
		echo $this->content;
	}

	private function prepareDocumentAction() {
		$this->doc = t3lib_div::makeInstance('template');
		$this->doc->backPath = $this->backPath;
		
		$GLOBALS['TBE_STYLES']['htmlTemplates']['sf_imagemap.html'] = t3lib_extMgm::extRelPath('sf_imagemap') . 'mod1/sf_imagemap.html';
		$this->doc->setModuleTemplate('sf_imagemap.html');
		#additional js-files
		$this->doc->loadJavascriptLib('contrib/scriptaculous/scriptaculous.js?load=builder,effects,dragdrop,controls,slider');
		$this->doc->docType = 'xhtml_trans';
	}
		
	private function noAccessAction() {
		$this->content .= $this->doc->startPage($this->getLL('title'));
	}
	
	private function createContentAction() {
		switch((string)$this->MOD_SETTINGS['function'])	{
			case 1:
			default:
				$this->selectMap();
				break;
			case 2:
				$this->editMap();
				break;
		}
	}
	
	protected function getButtons()	{
		$buttons = array(
			'csh' => '',
			'shortcut' => ''
		);
			// CSH
		//$buttons['csh'] = t3lib_BEfunc::cshItem('_MOD_web_func', '', $GLOBALS['BACK_PATH']);
			// Shortcut
		if ($GLOBALS['BE_USER']->mayMakeShortcut())	{
			$buttons['shortcut'] = $this->doc->makeShortcutIcon('', 'function', $this->MCONF['name']);
		}
		return $buttons;
	}
	
	protected function getFuncMenu() {
		$this->MOD_MENU = array (
			'function' => array (
				'1' => $this->getLL('selectMap'),
				'2' => $this->getLL('editMap'),
			)
		);
		
		$funcMenu = t3lib_BEfunc::getFuncMenu(
			0,
			'SET[function]',
			$this->MOD_SETTINGS['function'],
			$this->MOD_MENU['function']
		);
		return $funcMenu;
	}
	
	private function selectMap() {
		$select_fields = '*';
		$from_table = 'tx_sfimagemap_map';
		$where_clause = 'pid = ' . $this->id . ' AND deleted = 0 AND hidden = 0';
		$orderBy = 'sorting';

		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
			$select_fields,
			$from_table,
			$where_clause,
			$groupBy,
			$orderBy,
			$limit
		);
		
		while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
			$this->renderMapPreview($row);
		}
	}
	
	private function renderMapPreview(array $mapData) {
		debug($mapData['name']);
	}
	
	private function editMap() {
		
	}

	/**
	 * Access check!
	 * The page will show only if there is a valid page and if this page may be viewed by the user
	 * @return boolean the wether the access is accepted or denied
	 */
	private function getAccessRights() {
		$this->pageinfo = t3lib_BEfunc::readPageAccess($this->id,$this->perms_clause);
		$access = is_array($this->pageinfo) ? 1 : 0;
		
		if (($this->id && $access) || ($this->beUser->user['admin'] && !$this->id)) {
			return true;
		}
		
		return false;
	}
	
	private function getAction() {
		$action = current($this->actionQuee);
		return $action;
	}
	
	private function appendAction($value) {
		$this->actionQuee = array_merge($this->actionQuee, array($value));
	}
	
	/**
	 * Returns the Label for the given index.
	 * Just an abstract to get rid of all the global $LANG in the functions;
	 *
	 * @param	string $index: Index of Label in Languagearray
	 * @return	void
	 * @access	public
	 */
	private function getLL($index) {
		return $this->lang->getLL($index, $index);
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sf_imagemap/mod1/index.php'])    {
    include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sf_imagemap/mod1/index.php']);
}

	// Make instance:
$SOBE = t3lib_div::makeInstance('tx_sfimagemap_module1');
$SOBE->main();

?>
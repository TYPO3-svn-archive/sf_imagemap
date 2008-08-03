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
		global $BE_USER,$LANG,$BACK_PATH,$TCA_DESCR,$TCA,$CLIENT,$TYPO3_CONF_VARS;

		$this->backPath = $BACK_PATH;
		$this->beUser =& $BE_USER;
		$this->client =& $CLIENT;
		$this->lang =& $LANG;
		$this->tca =& $TCA;
		$this->tcaDescr =& $TCA_DESCR;
		$this->typo3ConfVars =& $TYPO3_CONF_VARS;
		
		parent::init();

		$this->appendAction('prepareDocument');
		
		if (!$this->getAccessRights()) {
			$this->appendAction('noAccess');
		} else {
			$this->appendAction('createContentHeader');
			$this->appendAction('createContent');
			$this->appendAction('createContentFooter');
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
			eval('$this->' . $this->getNextAction() . 'Action();');
			$i++; echo $this->getNextAction();
			debug($this->content);
		} while(current($this->actionQuee) && $i < 100);

		return $this->content;
	}

	private function prepareDocumentAction() {
		$this->doc = t3lib_div::makeInstance('mediumDoc');
		$this->doc->backPath = $this->backPath;
	}
	
	private function noAccessAction() {
		$this->content .= $this->doc->startPage($this->getLL('title'));
	}
	
	private function createContentHeaderAction() {
		$this->doc->form='<form action="" method="GET">';

			// JavaScript
		$this->doc->JScode = '
			<script language="javascript" type="text/javascript">
				script_ended = 0;
				function jumpToUrl(URL)	{
					document.location = URL;
				}
			</script>
		';
		$this->doc->postCode='
			<script language="javascript" type="text/javascript">
				script_ended = 1;
				if (top.fsMod) top.fsMod.recentIds["web"] = 0;
			</script>
		';
		
		$headerSection = $this->doc->getHeader('tx_sfimagemap_map', $this->pageinfo, $this->pageinfo['_thePath']).'<br />'.$this->lang->sL('LLL:EXT:lang/locallang_core.xml:labels.path').': '.t3lib_div::fixed_lgd_pre($this->pageinfo['_thePath'],50);

		$this->content .= $this->doc->startPage($this->getLL('title'));
		$this->content .= $this->doc->header($this->getLL('title'));
		$this->content .= $this->doc->spacer(5);
		$this->content .= $this->doc->section('',$this->doc->funcMenu($headerSection,t3lib_BEfunc::getFuncMenu($this->id,'SET[function]',$this->MOD_SETTINGS['function'],$this->MOD_MENU['function'])));
		$this->content .= $this->doc->divider(5);
	}
	
	private function createContentFooterAction() {
			// ShortCut
		if ($this->beUser->mayMakeShortcut())	{
			$this->content .= $this->doc->spacer(20) . $this->doc->section('',$this->doc->makeShortcutIcon('id',implode(',',array_keys($this->MOD_MENU)),$this->MCONF['name']));
		}
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
	
	public function menuConfig() {
		$this->MOD_MENU = array (
			'function' => array (
				'1' => $this->getLL('selectMap'),
				'2' => $this->getLL('editMap'),
			)
		);
		parent::menuConfig();		
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
	
	private function getNextAction() {
		$action = current($this->actionQuee);
		next($this->actionQuee);
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
echo $SOBE->main();

?>
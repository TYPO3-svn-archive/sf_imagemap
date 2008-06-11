<?php

unset($MCONF);
require ('conf.php');
require ($BACK_PATH.'init.php');
require ($BACK_PATH.'template.php');
$LANG->includeLLFile('EXT:sf_imagemap/mod1/locallang.xml');
require_once (PATH_t3lib.'class.t3lib_scbase.php');
$BE_USER->modAccess($MCONF,1);	// This checks permissions and exits if the users has no permission for entry.

t3lib_extMgm::isLoaded('cms',1);

	// We need the TCE forms functions
require_once (PATH_t3lib.'class.t3lib_loaddbgroup.php');
require_once (PATH_t3lib.'class.t3lib_tcemain.php');
require_once (PATH_t3lib.'class.t3lib_clipboard.php');

//require_once (PATH_t3lib."class.t3lib_page.php");

class tx_sfimagemap_module1 extends t3lib_SCbase {

	/**
	 * Initialisation of this backend module
	 *
	 * @return	void
	 * @access	public
	 */
	public function init() {
		parent::init();
		
		$this->MOD_SETTINGS = t3lib_BEfunc::getModuleData($this->MOD_MENU, t3lib_div::_GP('SET'), $this->MCONF['name']);
		
	}
	
	/**
	 * Preparing menu content and initializing clipboard and module TSconfig
	 *
	 * @return	void
	 * @access	public
	 */
	public function menuConfig()	{
		global $TYPO3_CONF_VARS;

		$this->MOD_MENU = array(
			'tt_content_showHidden' => 1,
			'showOutline' => 1,
			'clip_parentPos' => '',
			'clip' => '',
			'langDisplayMode' => '',
			'recordsView_table' => '',
			'recordsView_start' => ''
		);

			// page/be_user TSconfig settings and blinding of menu-items
		$this->modTSconfig = t3lib_BEfunc::getModTSconfig($this->id,'mod.'.$this->MCONF['name']);
		$this->MOD_MENU['view'] = t3lib_BEfunc::unsetMenuItems($this->modTSconfig['properties'],$this->MOD_MENU['view'],'menu.function');

		if (!isset($this->modTSconfig['properties']['sideBarEnable'])) $this->modTSconfig['properties']['sideBarEnable'] = 1;
		$this->modSharedTSconfig = t3lib_BEfunc::getModTSconfig($this->id, 'mod.SHARED');

			// CLEANSE SETTINGS
		$this->MOD_SETTINGS = t3lib_BEfunc::getModuleData($this->MOD_MENU, t3lib_div::_GP('SET'), $this->MCONF['name']);
	}
	
	/**
	 * Main function of the module.
	 *
	 * @return	void
	 * @access	public
	 */
	public function main() {
			// Draw the header.
		$this->doc = t3lib_div::makeInstance("mediumDoc");
		$this->doc->backPath = $BACK_PATH;
		
		if (($this->id && $access) || ($BE_USER->user["admin"] && !$this->id))	{
			$this->doc->form='<form action="" method="POST" enctype="multipart/form-data">';

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
					if (top.fsMod) top.fsMod.recentIds["web"] = '.intval($this->id).';
				</script>
			';

			$headerSection = $this->doc->getHeader("pages",$this->pageinfo,$this->pageinfo["_thePath"])."<br>".$LANG->sL("LLL:EXT:lang/locallang_core.php:labels.path").": ".t3lib_div::fixed_lgd_pre($this->pageinfo["_thePath"],50);

			$this->content .= $this->doc->startPage($this->getLL("title"));
			$this->content .= $this->doc->header($this->getLL("title"));
			$this->content .= $this->doc->spacer(5);
			$this->content .= $this->doc->section("",$this->doc->funcMenu($headerSection,""));
			$this->content .= $this->doc->divider(5);
			
			
			$this->content .= 'edit maparea shapes here';
		} else {
			$this->content .= $this->doc->startPage($this->getLL("title"));
			$this->content .= $this->doc->header($this->getLL("title"));
			$this->content .= $this->doc->spacer(5);
			$this->content .= $this->doc->spacer(10);
		}
	}
	
	/**
	 * Echoes the HTML output of this module
	 *
	 * @return	void
	 * @access	public
	 */
	public function printContent() {
		$this->content .= $this->doc->endPage();
		echo $this->content;
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
		global $LANG;
		return $LANG->getLL($index, $index);
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sf_imagemap/mod1/index.php'])    {
    include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sf_imagemap/mod1/index.php']);
}

	// Make instance:
$SOBE = t3lib_div::makeInstance('tx_sfimagemap_module1');
$SOBE->init();
$SOBE->main();
$SOBE->printContent();

?>
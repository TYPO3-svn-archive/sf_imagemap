<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

$TCA['tx_sfimagemap_map'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_map',		
		'label' => 'name',	
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'sortby' => 'sorting',
		'delete' => 'deleted',
		'dividers2tabs' => 1,
		'enablecolumns' => array(	
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'tca.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'icon_tx_sfimagemap_map.gif',
	),
	'feInterface' => array(
		'fe_admin_fieldList' => 'hidden, name, alt, image, width, height, areas',
	)
);
//t3lib_extMgm::addLLrefForTCAdescr('tx_sfimagemap_map', 'EXT:' . $_EXTKEY . '/locallang_csh_tx_sfimagemap_map.xml');

$TCA['tx_sfimagemap_area'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area',		
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY name',
		'delete' => 'deleted',	
		'enablecolumns' => array(		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'tca.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'icon_tx_sfimagemap_area.gif',
	),
	'feInterface' => array(
		'fe_admin_fieldList' => 'hidden, name, alt, activebydefault, hoverimage, shape, coordinates, content, linktomap, linktopage',
	)
);
//t3lib_extMgm::addLLrefForTCAdescr('tx_sfimagemap_area', 'EXT:' . $_EXTKEY . '/locallang_csh_tx_sfimagemap_area.xml');

t3lib_div::loadTCA('tt_content');
t3lib_extMgm::addPlugin(array('LLL:EXT:sf_imagemap/locallang_db.xml:tt_content.list_type_pi1', $_EXTKEY . '_pi1'), 'list_type');
t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_pi1', 'FILE:EXT:sf_imagemap/pi1/flexform_ds.xml');
t3lib_extMgm::addStaticFile($_EXTKEY, 'pi1/static/', 'Imagemap');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_pi1'] = 'layout,select_key,pages,recursive';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi1'] = 'pi_flexform';


?>
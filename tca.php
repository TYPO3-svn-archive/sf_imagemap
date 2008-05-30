<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_sfimagemap_map'] = array(
	'ctrl' => $TCA['tx_sfimagemap_map']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hidden,name,alt,image,areas'
	),
	'feInterface' => $TCA['tx_sfimagemap_map']['feInterface'],
	'columns' => array(
		'name' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_map.title',		
			'config' => Array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required',
			)
		),
		'hidden' => Array (		
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => Array (
				'type' => 'check',
				'default' => '0'
			)
		),
	),
	'types' => array(
		'0' => array('showitem' => '--div--;Karte, name;;1;;1-1-1, image, --div--;Gebiete, areas;;;;2-2-2')
	),
	'palettes' => array(
		'1' => array('showitem' => 'hidden;;1, alt')
	),
);

$TCA['tx_sfimagemap_area'] = array(
	'ctrl' => $TCA['tx_sfimagemap_area']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hidden,name,alt,hoverimage'
	),
	'feInterface' => $TCA['tx_sfimagemap_area']['feInterface'],
	'columns' => array(
	),
	'types' => array(
		'0' => array('showitem' => '--div--;Karte, title;;1;;1-1-1, hoverimage')
	),
	'palettes' => array(
		'1' => array('showitem' => 'hidden;;1, alt')
	),
);

?>
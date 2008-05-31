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
      	'image' => Array (        
            'exclude' => 0,        
            'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_map.image',        
            'config' => Array (
                'type' => 'group',
                'internal_type' => 'file',
                'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],    
                'max_size' => 1000,    
                'uploadfolder' => 'uploads/tx_sfimagemap',
                'show_thumbs' => 1,    
                'size' => 1,    
                'minitems' => 0,
                'maxitems' => 1,
            )
        ),
		'areas' => Array (		
			'exclude' => 1,		
			'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_map.areas',		
			'config' => Array (
				'type' => 'select',
				'size' => 20,
				'foreign_table' => 'tx_sfimagemap_area',
				'foreign_table_where' => 'AND (tx_sfimagemap_area.pid=###CURRENT_PID### OR tx_sfimagemap_area.pid=###STORAGE_PID###) ORDER BY title',
				'minitems' => 0,
         		'maxitems' => 100,
			)
		),
	),
	'types' => array(
		'0' => array('showitem' => 'name, hidden, --div--;LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_map.timage, image, --div--;LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_map.tareas, areas')
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
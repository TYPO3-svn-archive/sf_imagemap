<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_sfimagemap_map'] = array(
	'ctrl' => $TCA['tx_sfimagemap_map']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hidden,name,alt,image,preview,areas'
	),
	'feInterface' => $TCA['tx_sfimagemap_map']['feInterface'],
	'columns' => array(
		'name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_map.title',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'required',
			)
		),
		'hidden' => array(	
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
				'default' => '0'
			)
		),
      	'image' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_map.image',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'file',
                'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],    
                'max_size' => 1000,
                'uploadfolder' => 'uploads/tx_sfimagemap',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            )
        ),
        'preview' => array(
        	'explude' => 0,
        	'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_map.preview',
        	'displayCond' => 'FIELD:image:REQ:true',
        	'config' => array(
        		'type' => 'user',
        		'userFunc' => 'EXT:sf_imagemap/lib/class.tx_sfimagemap_controlls.php:&tx_sfimagemap_controlls->getSingleField_typePreview',
        		'field' => 'image',
        		'maxW' => 500,
        		'maxH' => 400,
        	)
        ),
		'areas' => array(
			'exclude' => 1,		
			'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_map.areas',		
			'config' => array(
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
		'0' => array('showitem' => 'name, hidden, --div--;LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_map.div_image, image, preview, --div--;LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_map.div_areas, areas')
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
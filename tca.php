<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_sfimagemap_map'] = array(
	'ctrl' => $TCA['tx_sfimagemap_map']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hidden,name,alt,title,image,width,height,preview,areas'
	),
	'feInterface' => $TCA['tx_sfimagemap_map']['feInterface'],
	'columns' => array(
		'name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_map.name',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'required',
			)
		),
		'alt' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_map.alt',
			'config' => array(
				'type' => 'input',
				'size' => '30',
			)
		),
		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_map.title',
			'config' => array(
				'type' => 'input',
				'size' => '30',
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
		'width' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_map.width',
			'config' => array(
				'type' => 'input',
				'size' => '5',
				'eval' => 'int',
			)
		),
		'height' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_map.height',
			'config' => array(
				'type' => 'input',
				'size' => '5',
				'eval' => 'int',
			)
		),
        'preview' => array(
        	'explude' => 0,
        	'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_map.preview',
        	'displayCond' => 'FIELD:image:REQ:true',
        	'config' => array(
        		'type' => 'user',
        		'userFunc' => 'EXT:sf_imagemap/lib/class.tx_sfimagemap_controlls.php:&tx_sfimagemap_controlls->getSingleField_typePreview',
        		'imageField' => 'image',
        		'widthField' => 'width',
        		'heightField' => 'height',
        	)
        ),
		'areas' => array(
			'exclude' => 1,		
			'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_map.areas',		
			'config' => array(
				'type' => 'select',
				'size' => 20,
				'foreign_table' => 'tx_sfimagemap_area',
				//'foreign_table_where' => 'AND (tx_sfimagemap_area.mid=###THIS_UID###) ORDER BY tx_sfimagemap_area.name',
				//'renderMode' => 'singlebox',
				/*new begin*/
        		'foreign_table_where' => ' ORDER BY tx_sfimagemap_area.name',
        		'MM' => 'tx_sfimagemap_mapnarea_mm',
				'MM_match_fields' => Array(
                        'tablenames' => 'tx_sfimagemap_area'
                ),

		        'maxitems' => 1000,
				'wizards' => array (
        			'_PADDING' => 5,
        			'_VERTICAL' => 1,
        			'_VALIGN' => 'top',
        			'edit' => array(
						'type' => 'popup',
						'title' => 'Edit filemount',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
        			),
        			'add' => array(
						'type' => 'script',
						'title' => 'Create new area',
						'icon' => 'add.gif',
						'params' => Array(
							'table'=>'tx_sfimagemap_area',
							'pid' => '0',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
        			'list' => array(
						'type' => 'script',
						'title' => 'List Areas',
						'icon' => 'list.gif',
						'params' => Array(
							'table'=>'tx_sfimagemap_area',
							'pid' => '0',
						),
						'script' => 'wizard_list.php',
        			)
				)
				/*new end*/
			)
		),
	),
	'types' => array(
		'0' => array('showitem' => 'hidden, name;;1, --div--;LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_map.imagetab, image;;2;;, preview, --div--;LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_map.areastab, areas')
	),
	'palettes' => array(
		'1' => array('showitem' => 'alt, title'),
		'2' => array('showitem' => 'width, height'),
	),
);

$TCA['tx_sfimagemap_area'] = array(
	'ctrl' => $TCA['tx_sfimagemap_area']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hidden,name,alt,title,map,image,active,coordinates,linked_content,linked_map,linked_page'
	),
	'feInterface' => $TCA['tx_sfimagemap_area']['feInterface'],
	'columns' => array(
		'name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.name',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'required',
			)
		),
		'alt' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.alt',
			'config' => array(
				'type' => 'input',
				'size' => '30',
			)
		),
		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.title',
			'config' => array(
				'type' => 'input',
				'size' => '30',
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
            'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.image',
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
        'active' => array(
        	'exclude' => 0,
        	'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.active',
        	'config' => array(
        		'type' => 'check',
        		'default' => '0'
        	)
        ),
        'coordinates' => array(
        	'exclude' => 0,
        	'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.coordinates',
			'config' => array(
				'type' => 'input',
				'size' => '30',
			)
        ),
		'map' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.map',
			'config' => array(
				'type' => 'select',
				'size' => '1',
				'maxitems' => '1',
				'minitems' => '0',
				'foreign_table' => 'tx_sfimagemap_map',
                'MM' => 'tx_sfimagemap_mapnarea_mm',
                'MM_foreign_select' => 1,
                'MM_opposite_field' => 'areas',
                'MM_match_fields' => Array(
                        'tablenames' => 'tx_sfimagemap_area'
                ),
			)
		),
        'linked_map' => array(
        	'exclude' => 0,
        	'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.linked_map',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'tx_sfimagemap_map',
				'size' => '1',
				'maxitems' => '1',
				'minitems' => '0',
			)
        ),
        'linked_content' => array(
        	'exclude' => 0,
        	'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.linked_content',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'tt_content',
				'size' => '5',
				'maxitems' => '20',
				'minitems' => '0',
			)
        ),
        'linked_page' => array(
        	'exclude' => 0,
        	'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.linked_page',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'pages',
				'size' => '1',
				'maxitems' => '1',
				'minitems' => '0',
			)
        ),
	),
	'types' => array(
		'0' => array('showitem' => 'hidden, name;;1, --div--;LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.imagetab, image, active, coordinates, --div--;LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.relationtab, map, linked_map, linked_content, linked_page')
	),
	'palettes' => array(
		'1' => array('showitem' => 'alt, title'),
	),
);

?>
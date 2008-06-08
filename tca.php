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
				'foreign_table_where' => 'AND (tx_sfimagemap_area.mid=###THIS_UID###) ORDER BY tx_sfimagemap_area.name',
        		'renderMode' => 'singlebox',
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
		'showRecordFieldList' => 'hidden,name,alt,title,mid,image,active,shape,coordinates,content,map,page'
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
        'shape' => array(
        	'exclude' => 0,
        	'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.shape',
        	'config' => array(
        		'type' => 'select',
        		'items' => Array (
					Array('LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.shape.1', '1'),
					Array('LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.shape.2', '2'),
					Array('LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.shape.3', '3'),
				)
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
		'mid' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.mid',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'tx_sfimagemap_map',
				'size' => '1',
				'maxitems' => '1',
				'minitems' => '0',
			)
		),
        'map' => array(
        	'exclude' => 0,
        	'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.map',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'tx_sfimagemap_map',
				'size' => '1',
				'maxitems' => '1',
				'minitems' => '0',
			)
        ),
        'content' => array(
        	'exclude' => 0,
        	'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.content',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'tt_content',
				'size' => '5',
				'maxitems' => '20',
				'minitems' => '0',
			)
        ),
        'page' => array(
        	'exclude' => 0,
        	'label' => 'LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.page',
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
		'0' => array('showitem' => 'hidden, name;;1, --div--;LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.imagetab, image, active, shape, coordinates, --div--;LLL:EXT:sf_imagemap/locallang_db.xml:tx_sfimagemap_area.relationtab, mid, map, content, page')
	),
	'palettes' => array(
		'1' => array('showitem' => 'alt, title'),
	),
);

?>
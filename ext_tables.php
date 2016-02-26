<?php
defined('TYPO3_MODE') or die();

// PAGE
$tempColumns = array();
$tempColumns['tx_imagecycle_mode'] = array(
	'exclude' => 1,
	'label' => 'LLL:EXT:imagecycle/locallang_db.xml:pages.tx_imagecycle_mode',
	'config' => array(
		'type' => 'select',
		'items' => array (
			array('LLL:EXT:imagecycle/locallang_db.xml:tt_content.pi_flexform.mode.I.recursiv', 'recursiv'),
		),
		'itemsProcFunc' => 'tx_imagecycle_itemsProcFunc->getModes',
		'displayMode' => 'page',
		'size' => 1,
		'maxitems' => 1,
	)
);
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('dam')) {
	$tempColumns['tx_imagecycle_damimages'] = array(
		'exclude' => 1,
		'label' => 'LLL:EXT:imagecycle/locallang_db.xml:pages.tx_imagecycle_damimages',
		'displayCond' => 'FIELD:tx_imagecycle_mode:=:dam',
		'config' => array(
			'type' => 'group',
			'form_type' => 'user',
			'userFunc' => 'EXT:dam/lib/class.tx_dam_tcefunc.php:&tx_dam_tceFunc->getSingleField_typeMedia',
			'userProcessClass' => 'EXT:mmforeign/class.tx_mmforeign_tce.php:tx_mmforeign_tce',
			'internal_type' => 'db',
			'allowed' => 'tx_dam',
			'allowed_types' => 'gif,jpg,jpeg,png',
			'prepend_tname' => 1,
			'MM' => 'tx_dam_mm_ref',
			'MM_foreign_select' => 1,
			'MM_opposite_field' => 1,
			'MM_match_fields' => array(
				'ident' => 'imagecycle',
			),
			'show_thumbs' => true,
			'size' => 10,
			'autoSizeMax' => 30,
			'minitems' => 0,
			'maxitems' => 1000,
		)
	);
	if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded("dam_catedit")) {
		$tempColumns['tx_imagecycle_damcategories'] = array(
			'exclude' => 1,
			'label' => 'LLL:EXT:imagecycle/locallang_db.xml:pages.tx_imagecycle_damcategories',
			'displayCond' => 'FIELD:tx_imagecycle_mode:=:dam_catedit',
			'config' => array(
				'type' => 'select',
				'form_type' => 'user',
				'userFunc' => 'EXT:dam/lib/class.tx_dam_tcefunc.php:tx_dam_tceFunc->getSingleField_selectTree',
				'treeViewClass' => 'EXT:dam/components/class.tx_dam_selectionCategory.php:tx_dam_selectionCategory',
				'foreign_table' => 'tx_dam_cat',
				'size' => 5,
				'autoSizeMax' => 25,
				'minitems' => 0,
				'maxitems' => 99,
			)
		);
	}
}
// Normal page fields
$tempColumns['tx_imagecycle_images'] = array(
	'exclude' => 1,
	'label' => 'LLL:EXT:imagecycle/locallang_db.xml:pages.tx_imagecycle_images',
	'displayCond' => 'FIELD:tx_imagecycle_mode:!IN:recursiv,,dam,dam_catedit',
	'config' => array(
		'type' => 'group',
		'internal_type' => 'file',
		'allowed' => 'gif,png,jpeg,jpg',
		'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
		'uploadfolder' => 'uploads/tx_imagecycle',
		'show_thumbs' => 1,
		'size' => 6,
		'minitems' => 0,
		'maxitems' => 1000,
	)
);
$tempColumns['tx_imagecycle_hrefs'] = array(
	'exclude' => 1,
	'label' => 'LLL:EXT:imagecycle/locallang_db.xml:pages.tx_imagecycle_hrefs',
	'displayCond' => 'FIELD:tx_imagecycle_mode:!IN:recursiv,,dam,dam_catedit',
	'config' => array(
		'type' => 'text',
		'wrap' => 'OFF',
		'cols' => '48',
		'rows' => '6',
	)
);
$tempColumns['tx_imagecycle_captions'] = array(
	'exclude' => 1,
	'label' => 'LLL:EXT:imagecycle/locallang_db.xml:pages.tx_imagecycle_captions',
	'displayCond' => 'FIELD:tx_imagecycle_mode:!IN:recursiv,,dam,dam_catedit',
	'config' => array(
		'type' => 'text',
		'wrap' => 'OFF',
		'cols' => '48',
		'rows' => '6',
	)
);
$tempColumns['tx_imagecycle_effect'] = array(
	'exclude' => 1,
	'label' => 'LLL:EXT:imagecycle/locallang_db.xml:pages.tx_imagecycle_effect',
	'config' => array(
		'type' => 'select',
		'items' => array(
			array('LLL:EXT:imagecycle/locallang_db.xml:tt_content.pi_flexform.from_ts', ''),
		),
		'itemsProcFunc' => 'tx_imagecycle_itemsProcFunc->getEffects',
		'size' => 1,
		'maxitems' => 1,
	)
);
$tempColumns['tx_imagecycle_stoprecursion'] = array(
	'exclude' => 1,
	'label' => 'LLL:EXT:imagecycle/locallang_db.xml:pages.tx_imagecycle_stoprecursion',
	'displayCond' => 'FIELD:tx_imagecycle_mode:!IN:recursiv,',
	'config' => array(
		'type' => 'check',
	)
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $tempColumns, 1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', '--div--;LLL:EXT:imagecycle/locallang_db.xml:pages.tx_imagecycle_div, tx_imagecycle_mode;;;;3-3-3, tx_imagecycle_damimages, tx_imagecycle_damcategories, tx_imagecycle_images, tx_imagecycle_hrefs, tx_imagecycle_captions, tx_imagecycle_effect, tx_imagecycle_stoprecursion');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages_language_overlay', $tempColumns, 1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages_language_overlay', '--div--;LLL:EXT:imagecycle/locallang_db.xml:pages.tx_imagecycle_div, tx_imagecycle_mode;;;;3-3-3, tx_imagecycle_damimages, tx_imagecycle_damcategories, tx_imagecycle_images, tx_imagecycle_hrefs, tx_imagecycle_captions, tx_imagecycle_effect, tx_imagecycle_stoprecursion');

$GLOBALS['TCA']['pages']['ctrl']['requestUpdate'] .= ($GLOBALS['TCA']['pages']['ctrl']['requestUpdate'] ? ',' : ''). 'tx_imagecycle_mode';
$GLOBALS['TCA']['pages_language_overlay']['ctrl']['requestUpdate'] .= ($GLOBALS['TCA']['pages_language_overlay']['ctrl']['requestUpdate'] ? ',' : ''). 'tx_imagecycle_mode';


// CONTENT
$tempColumns = array(
	"tx_imagecycle_activate" => array(
		"exclude" => 1,
		"label" => "LLL:EXT:imagecycle/locallang_db.xml:tt_content.tx_imagecycle_activate",
		"config" => array(
			"type" => "check",
		)
	),
	"tx_imagecycle_duration" => array(
		"exclude" => 1,
		"label" => "LLL:EXT:imagecycle/locallang_db.xml:tt_content.tx_imagecycle_duration",
		"config" => array(
			"type" => "input",
			"size" => "5",
			"trim" => "int",
			"default" => "6000"
		)
	),
);



\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('imagecycle', 'static/', 'Image-Cycle');


// tt_content
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('imagecycle', 'static/tt_content/', 'Image-Cycle for tt_content');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $tempColumns, 1);
$GLOBALS['TCA']['tt_content']['palettes']['tx_imagecycle'] = array(
	'showitem' => 'tx_imagecycle_activate,tx_imagecycle_duration',
	'canNotCollapse' => 1,
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content', '--palette--;LLL:EXT:imagecycle/locallang_db.xml:tt_content.tx_imagecycle_title;tx_imagecycle', 'textpic,image', 'before:imagecaption');



// tt_news
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('tt_news')) {
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('imagecycle', 'static/tt_news/', 'Image-Cycle for tt_news - Cycle');
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('imagecycle', 'static/tt_news/nivoslider/', 'Image-Cycle for tt_news - Nivo');
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_news', $tempColumns, 1);
	$GLOBALS['TCA']['tt_news']['palettes']['tx_imagecycle'] = array(
		'showitem' => 'tx_imagecycle_activate,tx_imagecycle_duration',
		'canNotCollapse' => 1,
	);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_news', '--palette--;LLL:EXT:imagecycle/locallang_db.xml:tt_content.tx_imagecycle_title;tx_imagecycle', '', 'after:image');
}



\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('imagecycle', 'static/coinslider/', 'Coin-Slider');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('imagecycle', 'static/nivoslider/', 'Nivo-Slider');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('imagecycle', 'static/crossslide/', 'Cross-Slide');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('imagecycle', 'static/slicebox/',   'Slice-Box');



$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['imagecycle_pi1'] = 'layout,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['imagecycle_pi1']     = 'pi_flexform,image_zoom';

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['imagecycle_pi2'] = 'layout,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['imagecycle_pi2']     = 'pi_flexform,image_zoom';

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['imagecycle_pi3'] = 'layout,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['imagecycle_pi3']     = 'pi_flexform,image_zoom';

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['imagecycle_pi4'] = 'layout,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['imagecycle_pi4']     = 'pi_flexform,image_zoom';

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['imagecycle_pi5'] = 'layout,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['imagecycle_pi5']     = 'pi_flexform,image_zoom';



// Load fields for DAM
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded("dam")) {
	// DAM
	$tempColumns = array(
		'tx_jfdam_link' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:imagecycle/locallang_db.xml:tx_dam.tx_jfdam_link',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'wizards' => array(
					'_PADDING' => 2,
					'link' => array(
						'type' => 'popup',
						'title' => 'Link',
						'icon' => 'link_popup.gif',
						'script' => 'browse_links.php?mode=wizard',
						'JSopenParams' => 'height=600,width=500,status=0,menubar=0,scrollbars=1'
					)
				)
			)
		),
	);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_dam', $tempColumns, 1);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_dam', '--div--;LLL:EXT:dam/locallang_db.xml:tx_dam_item.div_custom, tx_jfdam_link;;;;1-1-1');
	// add fields to index preset fields
	$GLOBALS['TCA']['tx_dam']['txdamInterface']['index_fieldList'] .= ',tx_jfdam_link';
}



// ICON pi1
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array(
	'LLL:EXT:imagecycle/locallang_db.xml:tt_content.list_type_pi1',
	'imagecycle_pi1',
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('imagecycle') . 'pi1/ce_icon.gif'
),'list_type');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('imagecycle_pi1', 'FILE:EXT:imagecycle/pi1/flexform_ds.xml');

// ICON pi2
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array(
	'LLL:EXT:imagecycle/locallang_db.xml:tt_content.list_type_pi2',
	'imagecycle_pi2',
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('imagecycle') . 'pi2/ce_icon.gif'
),'list_type');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('imagecycle'.'_pi2', 'FILE:EXT:imagecycle/pi2/flexform_ds.xml');

// ICON pi3
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array(
	'LLL:EXT:imagecycle/locallang_db.xml:tt_content.list_type_pi3',
	'imagecycle_pi3',
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('imagecycle') . 'pi3/ce_icon.gif'
),'list_type');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('imagecycle_pi3', 'FILE:EXT:imagecycle/pi3/flexform_ds.xml');

// ICON pi4
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array(
	'LLL:EXT:imagecycle/locallang_db.xml:tt_content.list_type_pi4',
	'imagecycle_pi4',
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('imagecycle') . 'pi4/ce_icon.gif'
),'list_type');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('imagecycle_pi4', 'FILE:EXT:imagecycle/pi4/flexform_ds.xml');

// ICON pi5
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array(
	'LLL:EXT:imagecycle/locallang_db.xml:tt_content.list_type_pi5',
	'imagecycle_pi5',
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('imagecycle') . 'pi5/ce_icon.gif'
),'list_type');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('imagecycle_pi5', 'FILE:EXT:imagecycle/pi5/flexform_ds.xml');

if (TYPO3_MODE == 'BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_imagecycle_pi1_wizicon'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('imagecycle').'pi1/class.tx_imagecycle_pi1_wizicon.php';
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_imagecycle_pi2_wizicon'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('imagecycle').'pi2/class.tx_imagecycle_pi2_wizicon.php';
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_imagecycle_pi3_wizicon'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('imagecycle').'pi3/class.tx_imagecycle_pi3_wizicon.php';
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_imagecycle_pi4_wizicon'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('imagecycle').'pi4/class.tx_imagecycle_pi4_wizicon.php';
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_imagecycle_pi5_wizicon'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('imagecycle').'pi5/class.tx_imagecycle_pi5_wizicon.php';
}

require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('imagecycle').'lib/class.tx_imagecycle_itemsProcFunc.php');
require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('imagecycle').'lib/class.tx_imagecycle_TCAform.php');
?>
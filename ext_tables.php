<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}



// PAGE
$tempColumns = array (
	'tx_imagecycle_images' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:imagecycle/locallang_db.xml:pages.tx_imagecycle_images',
		'config' => array (
			'type' => 'group',
			'internal_type' => 'file',
			'allowed' => 'gif,png,jpeg,jpg',
			'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
			'uploadfolder' => 'uploads/tx_imagecycle',
			'show_thumbs' => 1,
			'size' => 6,
			'minitems' => 0,
			'maxitems' => 25,
		)
	),
	'tx_imagecycle_hrefs' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:imagecycle/locallang_db.xml:pages.tx_imagecycle_hrefs',
		'config' => array (
			'type' => 'text',
			'wrap' => 'OFF',
			'cols' => '48',
			'rows' => '6',
		)
	),
	'tx_imagecycle_captions' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:imagecycle/locallang_db.xml:pages.tx_imagecycle_captions',
		'config' => array (
			'type' => 'text',
			'wrap' => 'OFF',
			'cols' => '48',
			'rows' => '6',
		)
	),
	'tx_imagecycle_effect' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:imagecycle/locallang_db.xml:pages.tx_imagecycle_effect',
		'config' => array (
			'type' => 'select',
			'itemsProcFunc' => 'tx_imagecycle_itemsProcFunc->getEffects',
			'size' => 1,
			'maxitems' => 1,
		)
	),
	'tx_imagecycle_stoprecursion' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:imagecycle/locallang_db.xml:pages.tx_imagecycle_stoprecursion',
		'config' => array (
			'type' => 'check',
		)
	),
);

t3lib_div::loadTCA('pages');
t3lib_extMgm::addTCAcolumns('pages', $tempColumns, 1);
t3lib_extMgm::addToAllTCAtypes('pages','tx_imagecycle_images;;;;1-1-1, tx_imagecycle_hrefs, tx_imagecycle_captions, tx_imagecycle_effect, tx_imagecycle_stoprecursion');

t3lib_div::loadTCA('pages_language_overlay');
t3lib_extMgm::addTCAcolumns('pages_language_overlay', $tempColumns, 1);
t3lib_extMgm::addToAllTCAtypes('pages_language_overlay','tx_imagecycle_images;;;;1-1-1, tx_imagecycle_hrefs, tx_imagecycle_captions, tx_imagecycle_effect, tx_imagecycle_stoprecursion');



// CONTENT
$tempColumns = Array (
	"tx_imagecycle_activate" => Array (
		"exclude" => 1,
		"label" => "LLL:EXT:imagecycle/locallang_db.xml:tt_content.tx_imagecycle_activate",
		"config" => Array (
			"type" => "check",
		)
	),
	"tx_imagecycle_duration" => Array (
		"exclude" => 1,
		"label" => "LLL:EXT:imagecycle/locallang_db.xml:tt_content.tx_imagecycle_duration",
		"config" => Array (
			"type" => "input",
			"size" => "5",
			"trim" => "int",
			"default" => "6000"
		)
	),
);

t3lib_div::loadTCA('tt_content');
t3lib_extMgm::addTCAcolumns('tt_content', $tempColumns, 1);
$GLOBALS['TCA']['tt_content']['palettes']['7']['showitem'] .= ',tx_imagecycle_activate,tx_imagecycle_duration';

t3lib_extMgm::addStaticFile($_EXTKEY,'static/', 'Image Cycle');

t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1'] = 'layout,select_key,pages';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1'] = 'pi_flexform,image_zoom';



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

t3lib_div::loadTCA('tx_dam');
t3lib_extMgm::addTCAcolumns('tx_dam', $tempColumns, 1);
t3lib_extMgm::addToAllTCAtypes('tx_dam', '--div--;LLL:EXT:dam/locallang_db.xml:tx_dam_item.div_custom, tx_jfdam_link;;;;1-1-1');

// add fields to index preset fields
$TCA['tx_dam']['txdamInterface']['index_fieldList'] .= ',tx_jfdam_link';



// ICON
t3lib_extMgm::addPlugin(array(
	'LLL:EXT:imagecycle/locallang_db.xml:tt_content.list_type_pi1',
	$_EXTKEY . '_pi1',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');

t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:'.$_EXTKEY.'/flexform_ds.xml');

if (TYPO3_MODE == 'BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_imagecycle_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_imagecycle_pi1_wizicon.php';
}

require_once(t3lib_extMgm::extPath($_EXTKEY).'lib/class.tx_imagecycle_itemsProcFunc.php');
?>
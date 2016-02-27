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

$GLOBALS['TCA']['pages']['ctrl']['requestUpdate'] .= ($GLOBALS['TCA']['pages']['ctrl']['requestUpdate'] ? ',' : ''). 'tx_imagecycle_mode';

<?php
defined('TYPO3_MODE') or die();

$relativeExtensionPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('imagecycle');

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

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $tempColumns, 1);
$GLOBALS['TCA']['tt_content']['palettes']['tx_imagecycle'] = array(
    'showitem' => 'tx_imagecycle_activate,tx_imagecycle_duration',
    'canNotCollapse' => 1,
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content', '--palette--;LLL:EXT:imagecycle/locallang_db.xml:tt_content.tx_imagecycle_title;tx_imagecycle', 'textpic,image', 'before:imagecaption');


// ICON pi1
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array(
    'LLL:EXT:imagecycle/locallang_db.xml:tt_content.list_type_pi1', 'imagecycle_pi1',
    $relativeExtensionPath . 'pi1/ce_icon.gif'
), 'list_type', 'imagecycle');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('imagecycle_pi1', 'FILE:EXT:imagecycle/pi1/flexform_ds.xml');

// ICON pi2
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array(
    'LLL:EXT:imagecycle/locallang_db.xml:tt_content.list_type_pi2', 'imagecycle_pi2',
    $relativeExtensionPath . 'pi2/ce_icon.gif'
) ,'list_type', 'imagecycle');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('imagecycle'.'_pi2', 'FILE:EXT:imagecycle/pi2/flexform_ds.xml');

// ICON pi3
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array(
    'LLL:EXT:imagecycle/locallang_db.xml:tt_content.list_type_pi3', 'imagecycle_pi3',
    $relativeExtensionPath . 'pi3/ce_icon.gif'
) ,'list_type', 'imagecycle');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('imagecycle_pi3', 'FILE:EXT:imagecycle/pi3/flexform_ds.xml');

// ICON pi4
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array(
    'LLL:EXT:imagecycle/locallang_db.xml:tt_content.list_type_pi4', 'imagecycle_pi4',
    $relativeExtensionPath . 'pi4/ce_icon.gif'
) ,'list_type', 'imagecycle');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('imagecycle_pi4', 'FILE:EXT:imagecycle/pi4/flexform_ds.xml');

// ICON pi5
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array(
    'LLL:EXT:imagecycle/locallang_db.xml:tt_content.list_type_pi5', 'imagecycle_pi5',
    $relativeExtensionPath . 'pi5/ce_icon.gif'
) ,'list_type', 'imagecycle');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('imagecycle_pi5', 'FILE:EXT:imagecycle/pi5/flexform_ds.xml');


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

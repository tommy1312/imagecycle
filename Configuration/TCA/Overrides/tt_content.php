<?php
defined('TYPO3_MODE') || die('Access denied.');

if (!defined ('IMAGECYLCE_EXT')) {
    define('IMAGECYLCE_EXT', 'imagecycle');
}

$table = 'tt_content';

$relativeExtensionPath = 'EXT:' . IMAGECYLCE_EXT . '/'; 

// CONTENT
$tempColumns = array(
    'tx_imagecycle_activate' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:' . IMAGECYLCE_EXT . '/locallang_db.xml:' . $table . '.tx_imagecycle_activate',
        'config' => array(
            'type' => 'check',
        )
    ),
    'tx_imagecycle_duration' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:' . IMAGECYLCE_EXT . '/locallang_db.xml:' . $table . '.tx_imagecycle_duration',
        'config' => array(
            'type' => 'input',
            'size' => '5',
            'trim' => 'int',
            'default' => '6000'
        )
    ),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns($table, $tempColumns);
$GLOBALS['TCA'][$table]['palettes']['tx_imagecycle'] = array(
    'showitem' => 'tx_imagecycle_activate,tx_imagecycle_duration',
    'canNotCollapse' => 1,
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes($table, '--palette--;LLL:EXT:' . IMAGECYLCE_EXT . '/locallang_db.xml:' . $table . '.tx_imagecycle_title;tx_imagecycle', 'textpic,image', 'before:imagecaption');

$listType = 'imagecycle_pi1';

// ICON pi1
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
    array(
        'LLL:EXT:' . IMAGECYLCE_EXT . '/locallang_db.xml:' . $table . '.list_type_pi1',
        $listType,
        $relativeExtensionPath . 'pi1/ce_icon.gif'
    ),
    'list_type',
    IMAGECYLCE_EXT
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $listType,
    'FILE:EXT:' . IMAGECYLCE_EXT . '/pi1/flexform_ds.xml'
);

$listType = 'imagecycle_pi2';

// ICON pi2
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
    array(
        'LLL:EXT:' . IMAGECYLCE_EXT . '/locallang_db.xml:' . $table . '.list_type_pi2', 
        $listType,
        $relativeExtensionPath . 'pi2/ce_icon.gif'
    ),
    'list_type',
    IMAGECYLCE_EXT
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $listType,
    'FILE:EXT:' . IMAGECYLCE_EXT . '/pi2/flexform_ds.xml'
);

$listType = 'imagecycle_pi3';

// ICON pi3
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
    array(
        'LLL:EXT:imagecycle/locallang_db.xml:' . $table . '.list_type_pi3',
        $listType,
        $relativeExtensionPath . 'pi3/ce_icon.gif'
    ),
    'list_type',
    IMAGECYLCE_EXT
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $listType, 
    'FILE:EXT:' . IMAGECYLCE_EXT . '/pi3/flexform_ds.xml'
);

$listType = 'imagecycle_pi4';

// ICON pi4
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
    array(
        'LLL:EXT:' . IMAGECYLCE_EXT . '/locallang_db.xml:' . $table . '.list_type_pi4',
        $listType,
        $relativeExtensionPath . 'pi4/ce_icon.gif'
    ),
    'list_type',
    IMAGECYLCE_EXT
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $listType,
    'FILE:EXT:' . IMAGECYLCE_EXT .'/pi4/flexform_ds.xml'
);

$listType = 'imagecycle_pi5';

// ICON pi5
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
    array(
        'LLL:EXT:' . IMAGECYLCE_EXT . '/locallang_db.xml:' . $table . '.list_type_pi5',
        $listType,
        $relativeExtensionPath . 'pi5/ce_icon.gif'
    ),
    'list_type',
    IMAGECYLCE_EXT
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $listType,
    'FILE:EXT:' . IMAGECYLCE_EXT . '/pi5/flexform_ds.xml'
);

$GLOBALS['TCA'][$table]['types']['list']['subtypes_excludelist']['imagecycle_pi1'] = 'layout,select_key,pages';
$GLOBALS['TCA'][$table]['types']['list']['subtypes_addlist']['imagecycle_pi1']     = 'pi_flexform,image_zoom';

$GLOBALS['TCA'][$table]['types']['list']['subtypes_excludelist']['imagecycle_pi2'] = 'layout,select_key,pages';
$GLOBALS['TCA'][$table]['types']['list']['subtypes_addlist']['imagecycle_pi2']     = 'pi_flexform,image_zoom';

$GLOBALS['TCA'][$table]['types']['list']['subtypes_excludelist']['imagecycle_pi3'] = 'layout,select_key,pages';
$GLOBALS['TCA'][$table]['types']['list']['subtypes_addlist']['imagecycle_pi3']     = 'pi_flexform,image_zoom';

$GLOBALS['TCA'][$table]['types']['list']['subtypes_excludelist']['imagecycle_pi4'] = 'layout,select_key,pages';
$GLOBALS['TCA'][$table]['types']['list']['subtypes_addlist']['imagecycle_pi4']     = 'pi_flexform,image_zoom';

$GLOBALS['TCA'][$table]['types']['list']['subtypes_excludelist']['imagecycle_pi5'] = 'layout,select_key,pages';
$GLOBALS['TCA'][$table]['types']['list']['subtypes_addlist']['imagecycle_pi5']     = 'pi_flexform,image_zoom';

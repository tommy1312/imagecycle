<?php
defined('TYPO3_MODE') || die('Access denied.');

$table = 'tt_news';

// tt_news
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('tt_news')) {
    // CONTENT
    $tempColumns = array(
        'tx_imagecycle_activate' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:imagecycle/locallang_db.xml:tt_content.tx_imagecycle_activate',
            'config' => array(
                'type' => 'check',
            )
        ),
        'tx_imagecycle_duration' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:imagecycle/locallang_db.xml:tt_content.tx_imagecycle_duration',
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
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_news', '--palette--;LLL:EXT:imagecycle/locallang_db.xml:tt_content.tx_imagecycle_title;tx_imagecycle', '', 'after:image');
}

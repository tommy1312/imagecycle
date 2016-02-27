<?php
defined('TYPO3_MODE') or die();

// tt_news
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('tt_news')) {
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

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('imagecycle', 'static/tt_news/', 'Image-Cycle for tt_news - Cycle');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('imagecycle', 'static/tt_news/nivoslider/', 'Image-Cycle for tt_news - Nivo');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_news', $tempColumns, 1);
    $GLOBALS['TCA']['tt_news']['palettes']['tx_imagecycle'] = array(
        'showitem' => 'tx_imagecycle_activate,tx_imagecycle_duration',
        'canNotCollapse' => 1,
    );
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_news', '--palette--;LLL:EXT:imagecycle/locallang_db.xml:tt_content.tx_imagecycle_title;tx_imagecycle', '', 'after:image');
}

<?php
defined('TYPO3_MODE') || die('Access denied.');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(IMAGECYLCE_EXT, 'static/', 'Image-Cycle');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(IMAGECYLCE_EXT, 'static/tt_content/', 'Image-Cycle for tt_content');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(IMAGECYLCE_EXT, 'static/coinslider/', 'Coin-Slider');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(IMAGECYLCE_EXT, 'static/nivoslider/', 'Nivo-Slider');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(IMAGECYLCE_EXT, 'static/crossslide/', 'Cross-Slide');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(IMAGECYLCE_EXT, 'static/slicebox/',   'Slice-Box');

if (TYPO3_MODE == 'BE') {
    $GLOBALS['TBE_MODULES_EXT']['xMOD_db_new_content_el']['addElClasses']['TYPO3Extension\\Imagecycle\\Controller\\WizardIcon'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath(IMAGECYLCE_EXT) . 'Classes/Controller/WizardIcon.php';
}

require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath(IMAGECYLCE_EXT) . 'lib/class.tx_imagecycle_itemsProcFunc.php');
require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath(IMAGECYLCE_EXT) . 'lib/class.tx_imagecycle_TCAform.php');

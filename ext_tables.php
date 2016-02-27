<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('imagecycle', 'static/', 'Image-Cycle');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('imagecycle', 'static/tt_content/', 'Image-Cycle for tt_content');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('imagecycle', 'static/coinslider/', 'Coin-Slider');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('imagecycle', 'static/nivoslider/', 'Nivo-Slider');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('imagecycle', 'static/crossslide/', 'Cross-Slide');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('imagecycle', 'static/slicebox/',   'Slice-Box');

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
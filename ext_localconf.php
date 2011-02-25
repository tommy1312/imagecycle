<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

// Page module hook
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['imagecycle_pi1']['imagecycle'] = 'EXT:imagecycle/lib/class.tx_imagecycle_cms_layout.php:tx_imagecycle_cms_layout->getExtensionSummary';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['imagecycle_pi2']['imagecycle'] = 'EXT:imagecycle/lib/class.tx_imagecycle_cms_layout.php:tx_imagecycle_cms_layout->getExtensionSummary';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['imagecycle_pi3']['imagecycle'] = 'EXT:imagecycle/lib/class.tx_imagecycle_cms_layout.php:tx_imagecycle_cms_layout->getExtensionSummary';

t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_imagecycle_pi1.php', '_pi1', 'list_type', 1);
t3lib_extMgm::addPItoST43($_EXTKEY, 'pi2/class.tx_imagecycle_pi2.php', '_pi2', 'list_type', 1);
t3lib_extMgm::addPItoST43($_EXTKEY, 'pi3/class.tx_imagecycle_pi3.php', '_pi3', 'list_type', 1);

$TYPO3_CONF_VARS['FE']['addRootLineFields'].= ',tx_imagecycle_mode,tx_imagecycle_damimages,tx_imagecycle_damcategories,tx_imagecycle_images,tx_imagecycle_hrefs,tx_imagecycle_captions,tx_imagecycle_effect,tx_imagecycle_stoprecursion';
?>
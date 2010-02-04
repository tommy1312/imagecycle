<?php
if (!defined ('TYPO3_MODE')) {
 	die ('Access denied.');
}

t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_imagecycle_pi1.php', '_pi1', 'list_type', 1);
$TYPO3_CONF_VARS['FE']['addRootLineFields'].= ',tx_imagecycle_images,tx_imagecycle_hrefs,tx_imagecycle_captions';
?>
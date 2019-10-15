<?php
$emClass = '\\TYPO3\\CMS\\Core\\Utility\\ExtensionManagementUtility';

$key = 'imagecycle';
$extensionPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($key, $script);

return array(
    'tx_imagecycle_tsparserext' => $extensionPath . 'lib/class.tx_imagecycle_tsparserext.php',
    'tx_imagecycle_pi1' => $extensionPath . 'pi1/class.tx_imagecycle_pi1.php',
    'tx_imagecycle_pi2' => $extensionPath . 'pi2/class.tx_imagecycle_pi2.php',
    'tx_imagecycle_pi3' => $extensionPath . 'pi3/class.tx_imagecycle_pi3.php',
    'tx_imagecycle_pi4' => $extensionPath . 'pi4/class.tx_imagecycle_pi4.php',
    'tx_imagecycle_pi5' => $extensionPath . 'pi5/class.tx_imagecycle_pi5.php',
);


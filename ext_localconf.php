<?php
defined('TYPO3_MODE') or die();

// Page module hook
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['imagecycle_pi1']['imagecycle'] = 'EXT:imagecycle/lib/class.tx_imagecycle_cms_layout.php:tx_imagecycle_cms_layout->getExtensionSummary';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['imagecycle_pi2']['imagecycle'] = 'EXT:imagecycle/lib/class.tx_imagecycle_cms_layout.php:tx_imagecycle_cms_layout->getExtensionSummary';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['imagecycle_pi3']['imagecycle'] = 'EXT:imagecycle/lib/class.tx_imagecycle_cms_layout.php:tx_imagecycle_cms_layout->getExtensionSummary';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['imagecycle_pi4']['imagecycle'] = 'EXT:imagecycle/lib/class.tx_imagecycle_cms_layout.php:tx_imagecycle_cms_layout->getExtensionSummary';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['imagecycle_pi5']['imagecycle'] = 'EXT:imagecycle/lib/class.tx_imagecycle_cms_layout.php:tx_imagecycle_cms_layout->getExtensionSummary';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43('imagecycle', 'pi1/class.tx_imagecycle_pi1.php', '_pi1', 'list_type', 1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43('imagecycle', 'pi2/class.tx_imagecycle_pi2.php', '_pi2', 'list_type', 1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43('imagecycle', 'pi3/class.tx_imagecycle_pi3.php', '_pi3', 'list_type', 1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43('imagecycle', 'pi4/class.tx_imagecycle_pi4.php', '_pi4', 'list_type', 1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43('imagecycle', 'pi5/class.tx_imagecycle_pi5.php', '_pi5', 'list_type', 1);

$GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] .= ',tx_imagecycle_mode,tx_imagecycle_damimages,tx_imagecycle_damcategories,tx_imagecycle_images,tx_imagecycle_hrefs,tx_imagecycle_captions,tx_imagecycle_effect,tx_imagecycle_stoprecursion';

// Define custom form engine data-provider
$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['formDataGroup']['flexFormSegment'][\TYPO3Extension\Imagecycle\Form\FormDataProvider\SelectOrCheckboxField::class] = [
    'depends' => TYPO3\CMS\Backend\Form\FormDataProvider\DatabaseRowDefaultValues::class,
];
foreach ([\TYPO3\CMS\Backend\Form\FormDataProvider\TcaSelectItems::class, \TYPO3\CMS\Backend\Form\FormDataProvider\TcaCheckboxItems::class] as $dataProviderName) {
    if (!isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['formDataGroup']['flexFormSegment'][$dataProviderName])) {
        continue;
    }
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['formDataGroup']['flexFormSegment'][$dataProviderName]['depends'][]
        = \TYPO3Extension\Imagecycle\Form\FormDataProvider\SelectOrCheckboxField::class;
}
?>
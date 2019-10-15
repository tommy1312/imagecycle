<?php
defined('TYPO3_MODE') || die('Access denied.');

if (!defined ('IMAGECYLCE_EXT')) {
    define('IMAGECYLCE_EXT', 'imagecycle');
}

// Page module hook

for ($i = 1; $i <= 5; $i++) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['imagecycle_pi' . $i][IMAGECYLCE_EXT] = 'TYPO3Extension\\Imagecycle\\Hooks\\CmsLayout->getExtensionSummary';

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43(IMAGECYLCE_EXT, 'pi' . $i . '/class.tx_imagecycle_pi' . $i . '.php', '_pi' . $i, 'list_type', 1);
}

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


if (TYPO3_MODE == 'BE') {
    $GLOBALS['TBE_MODULES_EXT']['xMOD_db_new_content_el']['addElClasses']['TYPO3Extension\\Imagecycle\\Controller\\WizardIcon'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('imagecycle') . 'Classes/Controller/WizardIcon.php';
}


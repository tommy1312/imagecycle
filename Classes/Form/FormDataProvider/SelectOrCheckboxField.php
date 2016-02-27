<?php
namespace TYPO3Extension\Imagecycle\Form\FormDataProvider;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Backend\Form\FormDataProviderInterface;
use TYPO3\CMS\Backend\Form\FormDataProvider\AbstractItemProvider;

/**
 * Resolves custom select or checkbox field.
 */
class SelectOrCheckboxField extends AbstractItemProvider implements FormDataProviderInterface
{
    const TCA_TYPE = 'imagecycle-selectOrCheckbox';

    /**
     * Resolve select of checkbox items.
     *
     * @param array $result
     * @return array
     * @throws \UnexpectedValueException
     */
    public function addData(array $result)
    {
        foreach ($result['processedTca']['columns'] as $fieldName => $fieldConfig) {
            if (empty($fieldConfig['config']['type']) || $fieldConfig['config']['type'] !== static::TCA_TYPE) {
                continue;
            }

            $fieldValue = null;
            if (array_key_exists($fieldName, $result['databaseRow'])) {
                $fieldValue = $result['databaseRow'][$fieldName];
            }

            if ($this->useSelectInsteadCheckbox()) {
                $fieldConfig['config']['type'] = 'select';
                $fieldConfig['config']['renderType'] = 'selectSingle';
                $fieldConfig['config']['items'] = array(
                    ['LLL:EXT:imagecycle/locallang_db.xml:tt_content.pi_flexform.from_ts', 2],
                    ['LLL:EXT:imagecycle/locallang_db.xml:tt_content.pi_flexform.yes', 1],
                    ['LLL:EXT:imagecycle/locallang_db.xml:tt_content.pi_flexform.no', 0],
                );
            } else {
                $fieldConfig['config']['type'] = 'check';
                // Conversion of special select value to checkbox value
                if (MathUtility::canBeInterpretedAsInteger($fieldValue) && (int)$fieldValue === 2) {
                    $result['databaseRow'][$fieldName] = (bool)$fieldConfig['config']['checked'];
                }
            }

            $result['processedTca']['columns'][$fieldName] = $fieldConfig;
        }

        return $result;
    }

    /**
     * @return bool
     */
    protected function useSelectInsteadCheckbox()
    {
        $configuration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['imagecycle']);
        return (!empty($configuration['useSelectInsteadCheckbox']));
    }
}
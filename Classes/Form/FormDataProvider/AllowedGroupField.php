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

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Backend\Form\FormDataProviderInterface;
use TYPO3\CMS\Backend\Form\FormDataProvider\AbstractItemProvider;

/**
 * Resolves group fields with allowed table configurations
 */
class AllowedGroupField extends AbstractItemProvider implements FormDataProviderInterface
{
    const TCA_TYPE = 'imagecycle-allowedGroup';

    /**
     * Resolves group fields with allowed table configurations.
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

            $fieldConfig['config']['type'] = 'group';

            $allowedTypesForCaption = $this->getAllowedTypesForCaption();
            if (!empty($allowedTypesForCaption)) {
                $fieldConfig['config']['allowed'] = $allowedTypesForCaption;
            } else {
                $fieldConfig['config']['allowed'] = 'tt_content,fe_users';
                if (ExtensionManagementUtility::isLoaded('tt_news')) {
                    $fieldConfig['config']['allowed'] .= ',tt_news';
                }
                if (ExtensionManagementUtility::isLoaded('tt_address')) {
                    $fieldConfig['config']['allowed'] .= ',tt_address';
                }
            }

            $result['processedTca']['columns'][$fieldName] = $fieldConfig;
        }

        return $result;
    }

    /**
     * @return string
     */
    protected function getAllowedTypesForCaption()
    {
        $allowedTypesForCaption = '';

        $configuration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['imagecycle']);
        if (!empty($configuration['allowedDbTypesForCaption'])) {
            $allowedTypesForCaption = $configuration['allowedDbTypesForCaption'];
        }

        return $allowedTypesForCaption;
    }
}
<?php
/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with TYPO3 source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace TYPO3Extension\Imagecycle\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * Class that adds the wizard icon.
 *
 * @category    Plugin
 * @package     TYPO3
 * @subpackage  imagecycle
 * @author      Franz Holzinger <franz@ttproducts.de>
 * @copyright   Causal Sàrl
 * @license     http://www.gnu.org/copyleft/gpl.html
 */
class WizardIcon
{
    /**
     * Processes the wizard items array.
     *
     * @param array $wizardItems The wizard items
     * @return array Modified array with wizard items
     */
    public function proc (array $wizardItems)
    {
        $iconRegistry = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
        $iconPath = 'Resources/Public/Icons/Wizard/';

        $wizardArray = array(
            'pi1' => array(
                    'list_type' => 'imagecycle_pi1',
                    'wizard_icon' => 'WizardImageCycle.gif'
                ),
            'pi2' => array(
                    'list_type' => 'imagecycle_pi2',
                    'wizard_icon' => 'WizardCoinSlider.gif'
                ),
            'pi3' => array(
                    'list_type' => 'imagecycle_pi3',
                    'wizard_icon' => 'WizardNivoSlider.gif'
                ),
            'pi4' => array(
                    'list_type' => 'imagecycle_pi4',
                    'wizard_icon' => 'WizardCrossSlide.gif'
                ),
            'pi5' => array(
                    'list_type' => 'imagecycle_pi5',
                    'wizard_icon' => 'WizardSliceBox.gif'
                ),
        );

        foreach ($wizardArray as $type => $wizardConf) {
            $params = '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=' . $wizardConf['list_type'];
            $wizardItem = array(
                'title' => $GLOBALS['LANG']->sL('LLL:EXT:' . IMAGECYLCE_EXT . 'locallang.xml:' . $type . '_title'),
                'description' => $GLOBALS['LANG']->sL('LLL:EXT:' . IMAGECYLCE_EXT . DIV2007_LANGUAGE_SUBPATH . 'locallang.xml:' . $type . '_plus_wiz_description'),
                'params' => $params
            );
            $iconIdentifier = 'extensions-imagecycle-' . $type . '-wizard';
            $iconRegistry->registerIcon(
                $iconIdentifier,
                'TYPO3\\CMS\\Core\\Imaging\\IconProvider\\BitmapIconProvider',
                array(
                    'source' => 'EXT:' . IMAGECYLCE_EXT . '/' . $iconPath . $wizardConf['wizard_icon'],
                )
            );
            $wizardItem['iconIdentifier'] = $iconIdentifier;
            $wizardItems['plugins_imagecycle_' . $type] = $wizardItem;
        }
        return $wizardItems;
    }
}

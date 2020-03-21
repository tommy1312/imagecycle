<?php

namespace TYPO3Extension\Imagecycle\Backend;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2009 Juergen Furrer <juergen.furrer@gmail.com>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  A copy is found in the textfile GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;

/**
 * Class that renders fields for the extensionmanager configuration
 *
 * @author     Juergen Furrer <juergen.furrer@gmail.com>
 * @package    TYPO3
 * @subpackage tx_imagecycle
 */

class ExtensionManagerConfiguration
{
	/**
	* Return the dropdown with all skins for constant editor
	*
	* @param array $params
	* @param object $tsObj
	*/
	public function getThemesNivo(&$params, &$tsObj)
	{
		$itemsProcFunc = GeneralUtility::makeInstance(TYPO3Extension\Imagecycle\Backend\ItemsProcFunc::class);
		$config = $itemsProcFunc->getThemesNivo(array('items'=> array()), array());
		$items = $config['items'];

		$raname = substr(md5($params['fieldName']), 0, 10);
		$aname = '\'' . $raname . '\'';
		$fN = $params['fieldName'];

		$p_field = '';
		foreach ($items as $var) {
			$label = $var[0];
			$value = isset($var[1]) ? $var[1] : $var[0];
			$sel = '';
			if ($value == $params['value']) {
				$sel = ' selected';
			}
			$p_field .= '<option value="' . htmlspecialchars($value) . '"' . $sel . '>' . $GLOBALS['LANG']->sL($label) . '</option>';
		}
		$p_field = '<select id="' . $fN . '" name="' . $fN . '" onChange="uFormUrl(' . $aname . ')">' . $p_field . '</select>';
	
		return $p_field;
	}

	/**
	 * Shows the update Message
	 *
	 * @return	string
	 */
	public function displayMessage(&$params, &$tsObj)
	{
		$out = '';

		$checkConfig = null;
		if ($this->checkConfig() === false) {
			$out = '
<div style="position:absolute;top:10px;right:10px; width:300px;">
	<div class="typo3-message message-warning">
		<div class="message-header">' . $GLOBALS['LANG']->sL('LLL:EXT:imagecycle/locallang.xml:extmng.classInnerHeader') . '</div>
		<div class="message-body">
			' . $GLOBALS['LANG']->sL('LLL:EXT:imagecycle/locallang.xml:extmng.classInner') . '
		</div>
	</div>
</div>';
		}

		return $out;
	}

	/**
	 * Check the config for a given feature
	 * 
	 * @return boolean
	 */
	public function checkConfig()
	{
		$confDefault = array(
			'effects',
			'effectsCoin',
			'nivoThemeFolder',
			'effectsNivo',
			'useSelectInsteadCheckbox',
			'allowedDbTypesForCaption',
		);
        if (class_exists(ExtensionConfiguration::class)) {
			$confArr = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('backend');
        } else {
            $confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['imagecycle']);
        }
		foreach ($confDefault as $val) {
			if (!isset($confArr[$val]) && !isset($_POST['data'][$val])) {
				return false;
			}
		}
		return true;
	}
}

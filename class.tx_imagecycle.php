<?php
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
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * @author	Juergen Furrer <juergen.furrer@gmail.com>
 * @package	TYPO3
 * @subpackage	tx_imagecycle
 */
class tx_imagecycle
{
	/**
	 * @var ContentObjectRenderer
	 */
	public $cObj;

	public function getSlideshow($content, $conf)
	{
		$return_string = NULL;
		if ($this->cObj->data['tx_imagecycle_activate']) {
			$instanceClass = ($conf['instanceClass'] ? $conf['instanceClass'] : ExtensionManagementUtility::extPath('imagecycle').'pi1/class.tx_imagecycle_pi1.php');
			if (! file_exists($instanceClass)) {
				// try to get the filename if file not exists
				$instanceClass = $GLOBALS['TSFE']->tmpl->getFileName($instanceClass);
			}
			if (! file_exists($instanceClass)) {
				GeneralUtility::devLog('Class \''.$instanceClass.'\' not found', 'imagecycle', 1);
				return $content;
			}
			require_once($instanceClass);
			$instance = ($conf["instance"] ? $conf["instance"] : 'tx_imagecycle_pi1');
			/** @var tx_imagecycle_pi1 $obj */
			$obj = GeneralUtility::makeInstance($instance);
			$obj->setContentKey($obj->extKey . '_' . $this->cObj->data['uid']);
			$obj->conf = $GLOBALS['TSFE']->tmpl->setup['plugin.'][$instance . '.'];
			// overwrite the width and height of the config
			$obj->conf['imagewidth'] = $GLOBALS['TSFE']->register['imagewidth'];
			$obj->conf['imageheight'] = $GLOBALS['TSFE']->register['imageheight'];
			if ($this->cObj->data['tx_imagecycle_duration'] > 0) {
				$obj->conf['displayDuration'] = $this->cObj->data['tx_imagecycle_duration'];
				$obj->conf['nivoPauseTime'] = $this->cObj->data['tx_imagecycle_duration'];
			}
			$obj->cObj = $this->cObj;
			$obj->type = 'content';
			$return_string = $obj->parseTemplate(array(), 'uploads/pics/', TRUE);
		}
		return $content;
	}
}

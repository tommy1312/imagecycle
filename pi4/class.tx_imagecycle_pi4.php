<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Juergen Furrer <juergen.furrer@gmail.com>
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
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */

require_once(t3lib_extMgm::extPath('imagecycle').'pi1/class.tx_imagecycle_pi1.php');

/**
 * Plugin 'Coin-Slider' for the 'imagecycle' extension.
 *
 * @author	Juergen Furrer <juergen.furrer@gmail.com>
 * @package	TYPO3
 * @subpackage	tx_imagecycle
 */
class tx_imagecycle_pi4 extends tx_imagecycle_pi1
{
	public $prefixId      = 'tx_imagecycle_pi4';
	public $scriptRelPath = 'pi4/class.tx_imagecycle_pi4.php';
	public $extKey        = 'imagecycle';
	public $pi_checkCHash = true;
	public $images        = array();
	public $hrefs         = array();
	public $captions      = array();
	public $type          = 'normal';
	protected $lConf      = array();
	protected $contentKey = null;
	protected $jsFiles    = array();
	protected $js         = array();
	protected $cssFiles   = array();
	protected $css        = array();
	protected $imageDir   = 'uploads/tx_imagecycle/';
	protected $templateFileJS = null;

	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	public function main($content, $conf)
	{
		$this->conf = $conf;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();

		// define the key of the element
		$this->setContentKey("imagecycle-cross");

		// set the system language
		$this->sys_language_uid = $GLOBALS['TSFE']->sys_language_content;

		if ($this->cObj->data['list_type'] == $this->extKey.'_pi4') {
			$this->type = 'normal';

			// It's a content, all data from flexform

			$this->lConf['mode']          = $this->getFlexformData('general', 'mode');
			$this->lConf['images']        = $this->getFlexformData('general', 'images', ($this->lConf['mode'] == 'upload'));
			$this->lConf['hrefs']         = $this->getFlexformData('general', 'hrefs', ($this->lConf['mode'] == 'upload'));
			$this->lConf['captions']      = $this->getFlexformData('general', 'captions', ($this->lConf['mode'] == 'upload'));
			$this->lConf['damimages']     = $this->getFlexformData('general', 'damimages', ($this->lConf['mode'] == 'dam'));
			$this->lConf['damcategories'] = $this->getFlexformData('general', 'damcategories', ($this->lConf['mode'] == 'dam_catedit'));

			$imagesRTE = $this->getFlexformData('general', 'imagesRTE', ($this->lConf['mode'] == 'uploadRTE'));
			$this->lConf['imagesRTE'] = array();
			if (isset($imagesRTE['el']) && count($imagesRTE['el']) > 0) {
				foreach ($imagesRTE['el'] as $elKey => $el) {
					if (is_numeric($elKey)) {
						$this->lConf['imagesRTE'][] = array(
							"image"   => $el['data']['el']['image']['vDEF'],
							"href"    => $el['data']['el']['href']['vDEF'],
							"caption" => $this->pi_RTEcssText($el['data']['el']['caption']['vDEF']),
						);
					}
				}
			}

			$this->lConf['imagewidth']  = $this->getFlexformData('settings', 'imagewidth');
			$this->lConf['imageheight'] = $this->getFlexformData('settings', 'imageheight');

			$this->lConf['crossTransition']    = $this->getFlexformData('movement', 'crossTransition');
			$this->lConf['crossTransitionDir'] = $this->getFlexformData('movement', 'crossTransitionDir');
			$this->lConf['crossTime']          = $this->getFlexformData('movement', 'crossTime');
			$this->lConf['crossFade']          = $this->getFlexformData('movement', 'crossFade');
			$this->lConf['crossVariant']       = $this->getFlexformData('movement', 'crossVariant');
			$this->lConf['crossFromTo']        = $this->getFlexformData('movement', 'crossFromTo');

			$this->lConf['options']         = $this->getFlexformData('special', 'options');
			$this->lConf['optionsOverride'] = $this->getFlexformData('special', 'optionsOverride');

			// define the key of the element
			$this->setContentKey("imagecycle-cross_c" . $this->cObj->data['uid']);

			// define the images
			switch ($this->lConf['mode']) {
				case "" : {}
				case "folder" : {}
				case "upload" : {
					$this->setDataUpload();
					break;
				}
				case "uploadRTE" : {
					$this->setDataUploadRTE();
					break;
				}
				case "dam" : {
					$this->setDataDam(false, 'tt_content', $this->cObj->data['uid']);
					break;
				}
				case "dam_catedit" : {
					$this->setDataDam(true, 'tt_content', $this->cObj->data['uid']);
					break;
				}
			}
			// Override the config with flexform data
			if ($this->lConf['imagewidth']) {
				$this->conf['imagewidth'] = $this->lConf['imagewidth'];
			}
			if ($this->lConf['imageheight']) {
				$this->conf['imageheight'] = $this->lConf['imageheight'];
			}
			if ($this->lConf['crossTransition']) {
				$this->conf['crossTransition'] = $this->lConf['crossTransition'];
			}
			if ($this->lConf['crossTransitionDir']) {
				$this->conf['crossTransitionDir'] = $this->lConf['crossTransitionDir'];
			}
			if ($this->lConf['crossTime']) {
				$this->conf['crossTime'] = $this->lConf['crossTime'];
			}
			if ($this->lConf['crossFade']) {
				$this->conf['crossFade'] = $this->lConf['crossFade'];
			}
			if ($this->lConf['crossFromTo']) {
				$this->conf['crossFromTo'] = $this->lConf['crossFromTo'];
			}
			// Will be overridden, if not "from TS"
			if ($this->lConf['crossVariant'] < 2) {
				$this->conf['crossVariant'] = $this->lConf['crossVariant'];
			}
			$this->conf['options'] = $this->lConf['options'];
		} else {
			$this->type = 'header';
			// It's the header
			$used_page = array();
			$pageID    = false;
			foreach ($GLOBALS['TSFE']->rootLine as $page) {
				if (! $pageID) {
					if (trim($page['tx_imagecycle_effect']) && ! $this->conf['disableRecursion']) {
						$this->conf['type'] = $page['tx_imagecycle_effect'];
					}
					if (
						(($page['tx_imagecycle_mode'] == 'upload' || ! $page['tx_imagecycle_mode']) && trim($page['tx_imagecycle_images']) != '') ||
						($page['tx_imagecycle_mode'] == 'dam'         && trim($page['tx_imagecycle_damimages']) != '') ||
						($page['tx_imagecycle_mode'] == 'dam_catedit' && trim($page['tx_imagecycle_damcategories']) != '') ||
						$this->conf['disableRecursion'] ||
						$page['tx_imagecycle_stoprecursion']
					) {
						$used_page = $page;
						$pageID    = $used_page['uid'];
						$this->lConf['mode']          = $used_page['tx_imagecycle_mode'];
						$this->lConf['damcategories'] = $used_page['tx_imagecycle_damcategories'];
					}
				}
			}
			if ($pageID) {
				if ($this->sys_language_uid) {
					$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('tx_imagecycle_images, tx_imagecycle_hrefs, tx_imagecycle_captions','pages_language_overlay','pid='.intval($pageID).' AND sys_language_uid='.$this->sys_language_uid,'','',1);
					$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
					if (trim($used_page['tx_imagecycle_effect'])) {
						$this->conf['type'] = $row['tx_imagecycle_effect'];
					}
				}
				// define the images
				switch ($this->lConf['mode']) {
					case "" : {}
					case "folder" : {}
					case "upload" : {
						$this->images   = t3lib_div::trimExplode(',',     $used_page['tx_imagecycle_images']);
						$this->hrefs    = t3lib_div::trimExplode(chr(10), $used_page['tx_imagecycle_hrefs']);
						$this->captions = t3lib_div::trimExplode(chr(10), $used_page['tx_imagecycle_captions']);
						// Language overlay
						if ($this->sys_language_uid) {
							if (trim($row['tx_imagecycle_images']) != '') {
								$this->images   = t3lib_div::trimExplode(',',     $row['tx_imagecycle_images']);
								$this->hrefs    = t3lib_div::trimExplode(chr(10), $row['tx_imagecycle_hrefs']);
								$this->captions = t3lib_div::trimExplode(chr(10), $row['tx_imagecycle_captions']);
							}
						}
						break;
					}
					case "dam" : {
						$this->setDataDam(false, 'pages', $pageID);
						break;
					}
					case "dam_catedit" : {
						$this->setDataDam(true, 'pages', $pageID);
						break;
					}
				}
			}
		}

		$crossFromTo = t3lib_div::trimExplode(LF, $this->conf['crossFromTo']);

		$data = array();
		foreach ($this->images as $key => $image) {
			list($from, $to) = t3lib_div::trimExplode('|', $crossFromTo[$key % count($crossFromTo)]);
			$data[$key]['image']   = $image;
			$data[$key]['href']    = $this->hrefs[$key];
			$data[$key]['caption'] = $this->captions[$key];
			$data[$key]['from']    = $from;
			$data[$key]['to']      = $to;
		}
		return $this->parseTemplate($data);
	}

	/**
	 * Parse all images into the template
	 * @param $data
	 * @return string
	 */
	public function parseTemplate($data=array(), $dir='', $onlyJS=false)
	{
		// define the directory of images
		if ($dir == '') {
			$dir = $this->imageDir;
		}

		// Check if $data is array
		if (count($data) == 0 && $onlyJS === false) {
			return false;
		}

		// define the contentKey if not exist
		if ($this->getContentKey() == '') {
			$this->setContentKey("imagecycle-cross_key");
		}

		if (! $this->conf['imagewidth']) {
			$this->conf['imagewidth'] = "200c";
		}
		if (! $this->conf['imageheight']) {
			$this->conf['imageheight'] = "200c";
		}

		// We have to build the images first to get the maximum width and height
		$returnString = null;
		$imagesString = null;
		$images = array();
		$maxWidth = 0;
		$maxHeight = 0;
		$factor = 1;
		$no_script = null;
		$GLOBALS['TSFE']->register['key'] = $this->getContentKey();
		$GLOBALS['TSFE']->register['imagewidth']  = $this->conf['imagewidth'] * $factor;
		$GLOBALS['TSFE']->register['imageheight'] = $this->conf['imageheight'] * $factor;
		$GLOBALS['TSFE']->register['showcaption'] = $this->conf['showcaption'] * $factor;
		$GLOBALS['TSFE']->register['IMAGE_NUM_CURRENT'] = 0;
		$GLOBALS['TSFE']->register['IMAGE_COUNT'] = count($data);
		if (count($data) > 0) {
			foreach ($data as $key => $item) {
				$image = null;
				$imgConf = $this->conf['cross.'][$this->type.'.']['image.'];
				$totalImagePath = $dir . $item['image'];
				$GLOBALS['TSFE']->register['file']    = $totalImagePath;
				$GLOBALS['TSFE']->register['href']    = $item['href'];
				$GLOBALS['TSFE']->register['caption'] = $item['caption'];
				$GLOBALS['TSFE']->register['CURRENT_ID'] = $GLOBALS['TSFE']->register['IMAGE_NUM_CURRENT'] + 1;
				$image = $this->cObj->IMAGE($imgConf);
				$lastImageInfo = $GLOBALS['TSFE']->lastImageInfo;
				if (intval($lastImageInfo[0] / $factor) > $maxWidth) {
					$maxWidth = intval($lastImageInfo[0] / $factor);
				}
				if (intval($lastImageInfo[1] / $factor) > $maxHeight) {
					$maxHeight = intval($lastImageInfo[1] / $factor);
				}
				// Add the noscript wrap to the firs image
				if ($key == 0) {
					$no_script = $this->cObj->stdWrap($image, $this->conf['cross.'][$this->type.'.']['noscriptWrap.']);
				}
				$images[] = array(
					'src'  => $lastImageInfo[3],
					'alt'  => $item['caption'],
					'from' => $item['from'],
					'to'   => $item['to'],
					'time' => ($this->conf['crossTime'] ? ($this->conf['crossTime'] / 1000) : 2),
				);
				$GLOBALS['TSFE']->register['IMAGE_NUM_CURRENT'] ++;
			}
			$returnString = $this->cObj->stdWrap(' ', $this->conf['cross.'][$this->type.'.']['stdWrap.']);
			$returnString .= $no_script;
			$imagesString = str_replace("\/", "/", json_encode($images));
		}

		// The template for JS
		if (! $this->templateFileJS = $this->cObj->fileResource($this->conf['templateFileJS'])) {
			$this->templateFileJS = $this->cObj->fileResource("EXT:imagecycle/res/tx_imagecycle.js");
		}

		// define the jQuery mode and function
		if ($this->conf['jQueryNoConflict']) {
			$jQueryNoConflict = "jQuery.noConflict();";
		} else {
			$jQueryNoConflict = "";
		}

		$this->addCSS("
#{$this->getContentKey()} {
	width: {$maxWidth}px;
	height: {$maxHeight}px;
}");

		$options = array();

		if ($this->conf['crossFade'] > 0) {
			$options['fade'] = "fade: ".($this->conf['crossFade'] / 1000);
		}
		if ($this->conf['crossTransitionDir'] && $this->conf['crossTransition']) {
			$options['easing'] = "easing: 'ease{$this->conf['crossTransitionDir']}{$this->conf['crossTransition']}'";
		}
		$options['variant'] = "variant: ".($this->conf['crossVariant'] ? 'true' : 'false');

		// overwrite all options if set
		if (trim($this->conf['options'])) {
			if ($this->conf['optionsOverride']) {
				$options = array($this->conf['options']);
			} else {
				$options['options'] = $this->conf['options'];
			}
		}

		// define the js file
		$this->addJsFile($this->conf['jQueryCross']);

		// define the css file
		$this->addCssFile($this->conf['cssFileCross']);

		// get the Template of the Javascript
		if (! $templateCode = trim($this->cObj->getSubpart($this->templateFileJS, "###TEMPLATE_CROSSSLIDER_JS###"))) {
			$templateCode = "alert('Template TEMPLATE_CROSSSLIDER_JS is missing')";
		}

		// define the markers
		$markerArray = array();
		$markerArray["KEY"]     = $this->getContentKey();
		$markerArray["OPTIONS"] = implode(",\n		", $options);
		$markerArray["IMAGES"] = $imagesString;

		// set the markers
		$templateCode = $this->cObj->substituteMarkerArray($templateCode, $markerArray, '###|###', 0);

		$this->addJS($jQueryNoConflict . $templateCode);

		// Add the ressources
		$this->addResources();

		if ($onlyJS === true) {
			return true;
		}

		return $returnString;
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/imagecycle/pi4/class.tx_imagecycle_pi4.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/imagecycle/pi4/class.tx_imagecycle_pi4.php']);
}

?>
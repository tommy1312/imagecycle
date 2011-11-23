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
class tx_imagecycle_pi3 extends tx_imagecycle_pi1
{
	public $prefixId      = 'tx_imagecycle_pi3';
	public $scriptRelPath = 'pi3/class.tx_imagecycle_pi3.php';
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
		$this->setContentKey("imagecycle-nivo");

		// set the system language
		$this->sys_language_uid = $GLOBALS['TSFE']->sys_language_content;

		if ($this->cObj->data['list_type'] == $this->extKey.'_pi3') {
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

			$this->lConf['nivoEffect']           = $this->getFlexformData('settings', 'nivoEffect');
			$this->lConf['nivoTheme']            = $this->getFlexformData('settings', 'nivoTheme');
			$this->lConf['imagewidth']           = $this->getFlexformData('settings', 'imagewidth');
			$this->lConf['imageheight']          = $this->getFlexformData('settings', 'imageheight');
			$this->lConf['thumbwidth']           = $this->getFlexformData('settings', 'thumbwidth');
			$this->lConf['thumbheight']          = $this->getFlexformData('settings', 'thumbheight');
			$this->lConf['nivoSlices']           = $this->getFlexformData('settings', 'nivoSlices');
			$this->lConf['nivoBoxCols']          = $this->getFlexformData('settings', 'nivoBoxCols');
			$this->lConf['nivoBoxRows']          = $this->getFlexformData('settings', 'nivoBoxRows');
			$this->lConf['nivoAnimSpeed']        = $this->getFlexformData('settings', 'nivoAnimSpeed');
			$this->lConf['nivoPauseTime']        = $this->getFlexformData('settings', 'nivoPauseTime');
			$this->lConf['nivoStartSlide']       = $this->getFlexformData('settings', 'nivoStartSlide');
			$this->lConf['nivoStartRandom']      = $this->getFlexformData('settings', 'nivoStartRandom');
			$this->lConf['nivoDirectionNav']     = $this->getFlexformData('settings', 'nivoDirectionNav');
			$this->lConf['nivoDirectionNavHide'] = $this->getFlexformData('settings', 'nivoDirectionNavHide');
			$this->lConf['nivoControlNav']       = $this->getFlexformData('settings', 'nivoControlNav');
			$this->lConf['nivoControlNavThumbs'] = $this->getFlexformData('settings', 'nivoControlNavThumbs');
			$this->lConf['nivoKeyboardNav']      = $this->getFlexformData('settings', 'nivoKeyboardNav');
			$this->lConf['nivoPauseOnHover']     = $this->getFlexformData('settings', 'nivoPauseOnHover');
			$this->lConf['nivoManualAdvance']    = $this->getFlexformData('settings', 'nivoManualAdvance');
			$this->lConf['nivoCaptionOpacity']   = $this->getFlexformData('settings', 'nivoCaptionOpacity');

			$this->lConf['options']         = $this->getFlexformData('special', 'options');
			$this->lConf['optionsOverride'] = $this->getFlexformData('special', 'optionsOverride');

			// define the key of the element
			$this->setContentKey("imagecycle-nivo_c" . $this->cObj->data['uid']);

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
			if ($this->lConf['nivoEffect']) {
				$this->conf['nivoEffect'] = implode(',', t3lib_div::trimExplode(',', $this->lConf['nivoEffect']));
			}
			if ($this->lConf['nivoTheme']) {
				$this->conf['nivoTheme'] = $this->lConf['nivoTheme'];
			}
			if ($this->lConf['imagewidth']) {
				$this->conf['imagewidth'] = $this->lConf['imagewidth'];
			}
			if ($this->lConf['imageheight']) {
				$this->conf['imageheight'] = $this->lConf['imageheight'];
			}
			if ($this->lConf['thumbwidth']) {
				$this->conf['thumbwidth'] = $this->lConf['thumbwidth'];
			}
			if ($this->lConf['thumbheight']) {
				$this->conf['thumbheight'] = $this->lConf['thumbheight'];
			}
			if ($this->lConf['nivoSlices']) {
				$this->conf['nivoSlices'] = $this->lConf['nivoSlices'];
			}
			if ($this->lConf['nivoBoxCols']) {
				$this->conf['nivoBoxCols'] = $this->lConf['nivoBoxCols'];
			}
			if ($this->lConf['nivoBoxRows']) {
				$this->conf['nivoBoxRows'] = $this->lConf['nivoBoxRows'];
			}
			if ($this->lConf['nivoAnimSpeed']) {
				$this->conf['nivoAnimSpeed'] = $this->lConf['nivoAnimSpeed'];
			}
			if ($this->lConf['nivoPauseTime']) {
				$this->conf['nivoPauseTime'] = $this->lConf['nivoPauseTime'];
			}
			if ($this->lConf['nivoStartSlide']) {
				$this->conf['nivoStartSlide'] = $this->lConf['nivoStartSlide'];
			}
			if ($this->lConf['nivoStartRandom'] < 2) {
				$this->conf['nivoStartRandom'] = $this->lConf['nivoStartRandom'];
			}
			if ($this->lConf['nivoCaptionOpacity']) {
				$this->conf['nivoCaptionOpacity'] = $this->lConf['nivoCaptionOpacity'];
			}
			// Will be overridden, if not "from TS"
			if ($this->lConf['nivoDirectionNav'] < 2) {
				$this->conf['nivoDirectionNav'] = $this->lConf['nivoDirectionNav'];
			}
			if ($this->lConf['nivoDirectionNavHide'] < 2) {
				$this->conf['nivoDirectionNavHide'] = $this->lConf['nivoDirectionNavHide'];
			}
			if ($this->lConf['nivoControlNav'] < 2) {
				$this->conf['nivoControlNav'] = $this->lConf['nivoControlNav'];
			}
			if ($this->lConf['nivoControlNavThumbs'] < 2) {
				$this->conf['nivoControlNavThumbs'] = $this->lConf['nivoControlNavThumbs'];
			}
			if ($this->lConf['nivoKeyboardNav'] < 2) {
				$this->conf['nivoKeyboardNav'] = $this->lConf['nivoKeyboardNav'];
			}
			if ($this->lConf['nivoPauseOnHover'] < 2) {
				$this->conf['nivoPauseOnHover'] = $this->lConf['nivoPauseOnHover'];
			}
			if ($this->lConf['nivoManualAdvance'] < 2) {
				$this->conf['nivoManualAdvance'] = $this->lConf['nivoManualAdvance'];
			}
			if ($this->lConf['options']) {
				$this->conf['options'] = $this->lConf['options'];
			}
			if ($this->lConf['optionsOverride'] < 2) {
				$this->conf['optionsOverride'] = $this->lConf['optionsOverride'];
			}
		} else {
			$this->type = 'header';
			// It's the header
			$used_page = array();
			$pageID    = false;
			foreach ($GLOBALS['TSFE']->rootLine as $page) {
				if (! $pageID) {
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

		$data = array();
		foreach ($this->images as $key => $image) {
			$data[$key]['image']   = $image;
			$data[$key]['href']    = $this->hrefs[$key];
			$data[$key]['caption'] = $this->captions[$key];
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
		$this->pagerenderer = t3lib_div::makeInstance('tx_imagecycle_pagerenderer');
		$this->pagerenderer->setConf($this->conf);

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
			$this->setContentKey("imagecycle-nivo_key");
		}

		if (! $this->conf['nivoEffect']) {
			$this->conf['nivoEffect'] = "random";
		}
		if (! $this->conf['imagewidth']) {
			$this->conf['imagewidth'] = "200c";
		}
		if (! $this->conf['imageheight']) {
			$this->conf['imageheight'] = "200c";
		}
		if (! $this->conf['thumbwidth']) {
			$this->conf['thumbwidth'] = "60c";
		}
		if (! $this->conf['thumbheight']) {
			$this->conf['thumbheight'] = "60c";
		}

		// define the css file
		$this->pagerenderer->addCssFile($this->conf['cssFileNivo']);

		// define the style
		$themeClass = 'theme-default';
		if ($this->conf['nivoTheme']) {
			$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['imagecycle']);
			if (! is_dir(t3lib_div::getFileAbsFileName($confArr['nivoThemeFolder']))) {
				// if the defined folder does not exist, define the default folder
				t3lib_div::devLog('Path \''.$confArr['nivoThemeFolder'].'\' does not exist', 'imagecycle', 1);
				$confArr['nivoThemeFolder'] = 'EXT:imagecycle/res/css/nivoslider/';
			}
			if (! is_dir(t3lib_div::getFileAbsFileName($confArr['nivoThemeFolder'] . $this->conf['nivoTheme']))) {
				// if the skin does not exist, the default skin will be selected
				t3lib_div::devLog('Skin \''.$this->conf['nivoTheme'].'\' does not exist', 'imagecycle', 1);
				$this->pagerenderer->addCssFile('EXT:imagecycle/res/css/nivoslider/default/style.css');
			} else {
				$this->pagerenderer->addCssFile($confArr['nivoThemeFolder'] . $this->conf['nivoTheme'] . '/style.css');
			}
			$themeClass = 'theme-'.$this->conf['nivoTheme'];
		}
		// Add the controlnav-thumbs
		if ($this->conf['nivoControlNavThumbs']) {
			$themeClass .= ' controlnav-thumbs';
		}

		$GLOBALS['TSFE']->register['themeclass'] = $themeClass;

		// We have to build the images first to get the maximum width and height
		$returnString = null;
		$images = null;
		$captions = null;
		$maxWidth = 0;
		$maxHeight = 0;
		$no_script = null;
		$GLOBALS['TSFE']->register['key'] = $this->getContentKey();
		$GLOBALS['TSFE']->register['imagewidth']  = $this->conf['imagewidth'];
		$GLOBALS['TSFE']->register['imageheight'] = $this->conf['imageheight'];
		$GLOBALS['TSFE']->register['showcaption'] = $this->conf['showcaption'];
		$GLOBALS['TSFE']->register['IMAGE_NUM_CURRENT'] = 0;
		$GLOBALS['TSFE']->register['IMAGE_COUNT'] = count($data);
		if (count($data) > 0) {
			foreach ($data as $key => $item) {
				$GLOBALS['TSFE']->register['caption_key'] = $this->getContentKey() . "-" .$GLOBALS['TSFE']->register['IMAGE_NUM_CURRENT'];
				$image = null;
				$imgConf = $this->conf['nivo.'][$this->type.'.']['image.'];
				$totalImagePath = $dir . $item['image'];
				// Thumb
				if ($this->conf['nivoControlNavThumbs']) {
					$thumbconf['file'] = $totalImagePath;
					$thumbconf['file.']['width']  = $this->conf['thumbwidth'];
					$thumbconf['file.']['height'] = $this->conf['thumbheight'];
					$GLOBALS['TSFE']->register['thumbrel'] = $this->cObj->IMG_RESOURCE($thumbconf);
				} else {
					$GLOBALS['TSFE']->register['thumbrel'] = '';
				}
				// 
				$GLOBALS['TSFE']->register['file']    = $totalImagePath;
				$GLOBALS['TSFE']->register['href']    = $item['href'];
				$GLOBALS['TSFE']->register['caption'] = $item['caption'];
				$GLOBALS['TSFE']->register['CURRENT_ID'] = $GLOBALS['TSFE']->register['IMAGE_NUM_CURRENT'] + 1;
				if ($this->hrefs[$key]) {
					$imgConf['imageLinkWrap.'] = $imgConf['imageHrefWrap.'];
				}
				$image = $this->cObj->IMAGE($imgConf);
				$lastImageInfo = $GLOBALS['TSFE']->lastImageInfo;
				if ($lastImageInfo[0] > $maxWidth) {
					$maxWidth = $lastImageInfo[0];
				}
				if ($lastImageInfo[1] > $maxHeight) {
					$maxHeight = $lastImageInfo[1];
				}
				// Add the noscript wrap to the firs image
				if ($key == 0) {
					$no_script = $this->cObj->stdWrap($image, $this->conf['nivo.'][$this->type.'.']['noscriptWrap.']);
				}
				$images .= $image;
				$captions .= $this->cObj->stdWrap($item['caption'], $this->conf['nivo.'][$this->type.'.']['captionWrap.']);
				$GLOBALS['TSFE']->register['IMAGE_NUM_CURRENT'] ++;
			}
			// the stdWrap
			$returnString = $this->cObj->stdWrap($images, $this->conf['nivo.'][$this->type.'.']['stdWrap.']);
			$returnString .= $captions;
			$returnString .= $no_script;
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

		if ($maxWidth == 0 && $maxHeight == 0 && count($GLOBALS['TSFE']->lastImageInfo)) {
			$lastImageInfo = $GLOBALS['TSFE']->lastImageInfo;
			$maxWidth = $lastImageInfo[0];
			$maxHeight = $lastImageInfo[1];
		}
		if ($this->cObj->currentRecord != $GLOBALS['TSFE']->currentRecord) {
			list($table, $uid) = t3lib_div::trimExplode(':', $GLOBALS['TSFE']->currentRecord, 1);
		} else {
			$uid = $this->cObj->data['uid'];
		}

		$this->pagerenderer->addCSS("
#c{$uid} .nivoSlider {
	width: {$maxWidth}px;
	height: {$maxHeight}px;
}");

		$options = array();

		$options['effect'] = "effect: '{$this->conf['nivoEffect']}'";

		// Set the language for prev and next
		$options['prev'] = "prevText: '".t3lib_div::slashJS($this->pi_getLL('prev'))."'";
		$options['next'] = "nextText: '".t3lib_div::slashJS($this->pi_getLL('next'))."'";

		if ($this->conf['nivoSlices'] > 0) {
			$options['slices'] = "slices: {$this->conf['nivoSlices']}";
		}
		if ($this->conf['nivoBoxCols'] > 0) {
			$options['boxCols'] = "boxCols: {$this->conf['nivoBoxCols']}";
		}
		if ($this->conf['nivoBoxRows'] > 0) {
			$options['boxRows'] = "boxRows: {$this->conf['nivoBoxRows']}";
		}
		if ($this->conf['nivoAnimSpeed'] > 0) {
			$options['animSpeed'] = "animSpeed: {$this->conf['nivoAnimSpeed']}";
		}
		if ($this->conf['nivoPauseTime'] > 0) {
			$options['pauseTime'] = "pauseTime: {$this->conf['nivoPauseTime']}";
		}
		if ($this->conf['nivoStartRandom']) {
			$options['startSlide'] = "startSlide: Math.floor(Math.random() * jQuery('#{$this->getContentKey()} img').length)";
		} elseif ($this->conf['nivoStartSlide'] > 0) {
			$options['startSlide'] = "startSlide: {$this->conf['nivoStartSlide']}";
		}
		if (strlen($this->conf['nivoCaptionOpacity']) > 0) {
			$options['captionOpacity'] = "captionOpacity: '{$this->conf['nivoCaptionOpacity']}'";
		}
		$options['directionNav']     = "directionNav: ".($this->conf['nivoDirectionNav'] ? 'true' : 'false');
		$options['directionNavHide'] = "directionNavHide: ".($this->conf['nivoDirectionNavHide'] ? 'true' : 'false');
		$options['controlNav']       = "controlNav: ".($this->conf['nivoControlNav'] ? 'true' : 'false');
		if ($this->conf['nivoControlNavThumbs']) {
			$options['controlNavThumbs']        = "controlNavThumbs: true";
			$options['controlNavThumbsFromRel'] = "controlNavThumbsFromRel: true";
		}
		$options['keyboardNav']      = "keyboardNav: ".($this->conf['nivoKeyboardNav'] ? 'true' : 'false');
		$options['pauseOnHover']     = "pauseOnHover: ".($this->conf['nivoPauseOnHover'] ? 'true' : 'false');
		$options['manualAdvance']    = "manualAdvance: ".($this->conf['nivoManualAdvance'] ? 'true' : 'false');

		// overwrite all options if set
		if (trim($this->conf['options'])) {
			if ($this->conf['optionsOverride']) {
				$options = array($this->conf['options']);
			} else {
				$options['options'] = $this->conf['options'];
			}
		}

		// checks if t3jquery is loaded
		if (T3JQUERY === true) {
			tx_t3jquery::addJqJS();
		} else {
			$this->pagerenderer->addJsFile($this->conf['jQueryLibrary'], true);
		}

		// define the js file
		$this->pagerenderer->addJsFile($this->conf['jQueryNivo']);

		// get the Template of the Javascript
		if (! $templateCode = trim($this->cObj->getSubpart($this->templateFileJS, "###TEMPLATE_NIVOSLIDER_JS###"))) {
			$templateCode = "alert('Template TEMPLATE_NIVOSLIDER_JS is missing')";
		}

		// define the markers
		$markerArray = array();
		$markerArray["KEY"]     = $this->getContentKey();
		$markerArray["OPTIONS"] = implode(",\n		", $options);

		// set the markers
		$templateCode = $this->cObj->substituteMarkerArray($templateCode, $markerArray, '###|###', 0);

		$this->pagerenderer->addJS($jQueryNoConflict . $templateCode);

		// Add the ressources
		$this->pagerenderer->addResources();

		if ($onlyJS === true) {
			return true;
		}

		return $returnString;
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/imagecycle/pi3/class.tx_imagecycle_pi3.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/imagecycle/pi3/class.tx_imagecycle_pi3.php']);
}

?>
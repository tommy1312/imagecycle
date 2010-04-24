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

require_once(PATH_tslib.'class.tslib_pibase.php');

if (t3lib_extMgm::isLoaded('t3jquery')) {
	require_once(t3lib_extMgm::extPath('t3jquery').'class.tx_t3jquery.php');
}

/**
 * Plugin 'Image Cycle' for the 'imagecycle' extension.
 *
 * @author	Juergen Furrer <juergen.furrer@gmail.com>
 * @package	TYPO3
 * @subpackage	tx_imagecycle
 */
class tx_imagecycle_pi1 extends tslib_pibase
{
	var $prefixId      = 'tx_imagecycle_pi1';		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_imagecycle_pi1.php';	// Path to this script relative to the extension dir.
	var $extKey        = 'imagecycle';	// The extension key.
	var $pi_checkCHash = true;
	var $lConf = array();
	var $contentKey = null;
	var $jsFiles = array();
	var $js = array();
	var $css = array();
	var $images = array();
	var $hrefs = array();
	var $captions = array();
	var $imageDir = 'uploads/tx_imagecycle/';
	var $type = 'normal';

	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	function main($content, $conf)
	{
		$this->conf = $conf;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();

		// define the key of the element
		$this->contentKey = "imagecycle";

		// set the system language
		$this->sys_language_uid = $GLOBALS['TSFE']->sys_language_content;

		$pageID = false;
		if ($this->cObj->data['list_type'] == $this->extKey.'_pi1') {
			$this->type = 'normal';
			// It's a content, al data from flexform
			// Set the Flexform information
			$this->pi_initPIflexForm();
			$piFlexForm = $this->cObj->data['pi_flexform'];
			foreach ($piFlexForm['data'] as $sheet => $data) {
				foreach ($data as $lang => $value) {
					foreach ($value as $key => $val) {
						$this->lConf[$key] = $this->pi_getFFvalue($piFlexForm, $key, $sheet);
					}
				}
			}

			// define the key of the element
			$this->contentKey .= "_c" . $this->cObj->data['uid'];

			// define the images
			if ($this->lConf['images']) {
				switch ($this->lConf['mode']) {
					case "" : {}
					case "folder" : {}
					case "upload" : {
						$this->setDataUpload();
						break;
					}
					case "dam" : {
						$this->setDataDam(false);
						break;
					}
					case "dam_catedit" : {
						$this->setDataDam(true);
						break;
					}
				}
			}
			// Override the config with flexform data
			if ($this->lConf['imagewidth']) {
				$this->conf['imagewidth'] = $this->lConf['imagewidth'];
			}
			if ($this->lConf['imageheight']) {
				$this->conf['imageheight'] = $this->lConf['imageheight'];
			}
			if ($this->lConf['type']) {
				$this->conf['type'] = $this->lConf['type'];
			}
			if ($this->lConf['transition']) {
				$this->conf['transition'] = $this->lConf['transition'];
			}
			if ($this->lConf['transitiondir']) {
				$this->conf['transitionDir'] = $this->lConf['transitiondir'];
			}
			if ($this->lConf['transitionduration']) {
				$this->conf['transitionDuration'] = $this->lConf['transitionduration'];
			}
			if ($this->lConf['displayduration']) {
				$this->conf['displayDuration'] = $this->lConf['displayduration'];
			}
			if (is_numeric($this->lConf['delayduration']) && $this->lConf['delayduration'] != 0) {
				$this->conf['delayDuration'] = $this->lConf['delayduration'];
			}
			$this->conf['showcaption'] = $this->lConf['showcaption'];
			$this->conf['stopOnMousover'] = $this->lConf['stoponmousover'];
			$this->conf['sync'] = $this->lConf['sync'];
			$this->conf['random'] = $this->lConf['random'];
			$this->conf['options'] = $this->lConf['options'];
		} else {
			$this->type = 'header';
			// It's the header
			foreach ($GLOBALS['TSFE']->rootLine as $page) {
				if ($page['tx_imagecycle_stoprecursion']) {
					break;
				}
				if (trim($page['tx_imagecycle_effect']) && ! $this->conf['disableRecursion']) {
					$this->conf['type'] = $page['tx_imagecycle_effect'];
				}
				if (trim($page['tx_imagecycle_images']) != '' || $this->conf['disableRecursion']) {
					$this->images   = t3lib_div::trimExplode(',', $page['tx_imagecycle_images']);
					$this->hrefs    = t3lib_div::trimExplode(chr(10), $page['tx_imagecycle_hrefs']);
					$this->captions = t3lib_div::trimExplode(chr(10), $page['tx_imagecycle_captions']);
					$pageID = $page['uid'];
					break;
				}
			}
			if ($pageID && $this->sys_language_uid) {
				$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('tx_imagecycle_images, tx_imagecycle_hrefs, tx_imagecycle_captions','pages_language_overlay','pid='.intval($pageID).' AND sys_language_uid='.$this->sys_language_uid,'','',1);
				$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
				if (trim($page['tx_imagecycle_effect'])) {
					$this->conf['type'] = $row['tx_imagecycle_effect'];
				}
				if (trim($row['tx_imagecycle_images']) != '') {
					$this->images   = t3lib_div::trimExplode(',', $row['tx_imagecycle_images']);
					$this->hrefs    = t3lib_div::trimExplode(chr(10), $row['tx_imagecycle_hrefs']);
					$this->captions = t3lib_div::trimExplode(chr(10), $row['tx_imagecycle_captions']);
				}
			}
		}

		$data = array();
		foreach ($this->images as $key => $image) {
			$data[$key]['image']   = $image;
			$data[$key]['href']    = $this->hrefs[$key];
			$data[$key]['caption'] = ($this->conf['showcaption'] ? $this->captions[$key] : '');
		}

		return $this->pi_wrapInBaseClass($this->parseTemplate($data));
	}

	/**
	 * Set the Information of the images if mode = upload
	 * @return boolean
	 */
	function setDataUpload()
	{
		// define the images
		$this->images = t3lib_div::trimExplode(',', $this->lConf['images']);
		// define the hrefs
		if ($this->lConf['hrefs']) {
			$this->hrefs = t3lib_div::trimExplode(chr(10), $this->lConf['hrefs']);
		}
		// define the captions
		if ($this->lConf['captions']) {
			$this->captions = t3lib_div::trimExplode(chr(10), $this->lConf['captions']);
		}
		return true;
	}

	/**
	 * Set the Information of the images if mode = dam
	 * @return boolean
	 */
	function setDataDam($fromCategory=false)
	{
		// clear the imageDir
		$this->imageDir = '';
		// get all fields for captions
		$damCaptionFields = t3lib_div::trimExplode(',', $this->conf['damCaptionFields'], true);
		$damHrefFields    = t3lib_div::trimExplode(',', $this->conf['damHrefFields'], true);
		$fields  = (count($damCaptionFields) > 0 ? ','.implode(',tx_dam.', $damCaptionFields) : '');
		$fields .= (count($damHrefFields) > 0    ? ','.implode(',tx_dam.', $damHrefFields)    : '');
		if ($fromCategory === true) {
			// Get the images from dam category
			$damcategories = $this->getDamcats($this->lConf['damcategories']);
			$res = $GLOBALS['TYPO3_DB']->exec_SELECT_mm_query(
				tx_dam_db::getMetaInfoFieldList() . $fields,
				'tx_dam',
				'tx_dam_mm_cat',
				'tx_dam_cat',
				" AND tx_dam_cat.uid IN (".implode(",", $damcategories).") AND tx_dam.file_mime_type='image' AND tx_dam.sys_language_uid=" . $GLOBALS['TYPO3_DB']->fullQuoteStr($this->sys_language_uid, 'tx_dam'),
				'',
				'tx_dam.sorting',
				''
			);
			while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
				$images['rows'][] = $row;
			}
		} else {
			// Get the images from dam
			$images = tx_dam_db::getReferencedFiles(
				'tt_content',
				$this->cObj->data['uid'],
				'imagecycle',
				'tx_dam_mm_ref',
				tx_dam_db::getMetaInfoFieldList() . $fields,
				"tx_dam.file_mime_type = 'image'"
			);
		}
		if (count($images['rows']) > 0) {
			// overlay the translation
			$conf = array(
				'sys_language_uid' => $this->sys_language_uid,
				'lovl_mode' => ''
			);
			// add image
			foreach ($images['rows'] as $key => $row) {
				$row = tx_dam_db::getRecordOverlay('tx_dam', $row, $conf);
				// set the data
				$this->images[] = $row['file_path'].$row['file_dl_name'];$
				// set the href
				$href = '';
				unset($href);
				if (count($damHrefFields) > 0) {
					foreach ($damHrefFields as $damHrefField) {
						if (! isset($href) && trim($row[$damHrefField])) {
							$href = $row[$damHrefField];
							break;
						}
					}
				}
				$this->hrefs[] = $href;
				// set the caption
				$caption = '';
				unset($caption);
				if (count($damCaptionFields) > 0) {
					foreach ($damCaptionFields as $damCaptionField) {
						if (! isset($caption) && trim($row[$damCaptionField])) {
							$caption = $row[$damCaptionField];
							break;
						}
					}
				}
				$this->captions[] = $caption;
			}
		}
		return true;
	}

	/**
	 * return all DAM categories including subcategories
	 *
	 * @return	array
	 */
	function getDamcats($dam_cat='')
	{
		$damCats = t3lib_div::trimExplode(",", $dam_cat, true);
		if (count($damCats) < 1) {
			return;
		} else {
			// select subcategories
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
				'uid, parent_id',
				'tx_dam_cat',
				'parent_id IN ('.implode(",", $damCats).') '.$this->cObj->enableFields('tx_dam_cat'),
				'',
				'parent_id',
				''
			);
			$subcats = array();
			while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
				$damCats[] = $row['uid'];
			}
		}
		return $damCats;
	}

	/**
	 * Parse all images into the template
	 * @param $data
	 * @return string
	 */
	function parseTemplate($data=array(), $dir='', $onlyJS=false)
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
		if ($this->contentKey == '') {
			$this->contentKey = "imagecycle_key";
		}

		// define the jQuery mode and function
		if ($this->conf['jQueryNoConflict']) {
			$jQueryNoConflict = "jQuery.noConflict();";
		} else {
			$jQueryNoConflict = "";
		}

		$options = array();
		if (! $this->conf['imagewidth']) {
			$this->conf['imagewidth'] = ($this->conf['imagewidth'] ? $this->conf['imagewidth'] : "200c");
		}
		if (! $this->conf['imageheight']) {
			$this->conf['imageheight'] = ($this->conf['imageheight'] ? $this->conf['imageheight'] : "200c");
		}
		if ($this->conf['type']) {
			$options[] = "fx: '{$this->conf['type']}'";
		}
		if ($this->conf['transitionDir'] && $this->conf['transition']) {
			$options[] = "easing: 'ease{$this->conf['transitionDir']}{$this->conf['transition']}'";
		}
		if ($this->conf['transitionDuration'] > 0) {
			$options[] = "speed: '{$this->conf['transitionDuration']}'";
		}
		if ($this->conf['displayDuration'] > 0) {
			$options[] = "timeout: '{$this->conf['displayDuration']}'";
		}
		if (is_numeric($this->conf['delayDuration']) && $this->conf['delayDuration'] != 0) {
			$options[] = "delay: {$this->conf['delayDuration']}";
		}
		if ($this->conf['stopOnMousover']) {
			$options[] = "pause: true";
		}
		$options[] = "sync: ".($this->conf['sync'] ? 'true' : 'false');
		$options[] = "random: ".($this->conf['random'] ? 'true' : 'false');

		// overwrite all options if set
		if (trim($this->conf['options'])) {
			$options = array($this->conf['options']);
		}

		// add caption
		if ($this->conf['showcaption']) {
			// define the animation for the caption
			$fx = array();
			if (! $this->conf['captionAnimate']) {
				$options[] = "before: function() {jQuery('span', this).css('display', 'none');}";
				$options[] = "after: function() {jQuery('span', this).css('display', 'block');}";
			} else {
				if ($this->conf['captionTypeOpacity']) {
					$fx[] = "opacity: 'show'";
				}
				if ($this->conf['captionTypeHeight']) {
					$fx[] = "height: 'show'";
				}
				if ($this->conf['captionTypeWidth']) {
					$fx[] = "width: 'show'";
				}
				// if no effect is choosen, opacity is the fallback
				if (count($fx) < 1) {
					$fx[] = "opacity: 'show'";
				}
				if (! is_numeric($this->conf['captionSpeed'])) {
					$this->conf['captionSpeed'] = 200;
				}
				$options[] = "before: function() {jQuery('span', this).css('display', 'none');}";
				$options[] = "after:  function() {jQuery('span', this).animate({".(implode(",", $fx))."},{$this->conf['captionSpeed']});}";
			}
		}
		// define the js file
		$this->addJsFile($this->conf['jQueryCycle']);

		$this->addJS(
			$jQueryNoConflict . "
jQuery(document).ready(function() {
	jQuery('#". $this->contentKey ."').show().cycle(".(count($options) ? "{\n		".implode(",\n		", $options)."\n	}" : "").");
});");

		// Add the ressources
		$this->addResources();

		if ($onlyJS === true) {
			return true;
		}

		$return_string = null;
		$images = null;
		$GLOBALS['TSFE']->register['key'] = $this->contentKey;
		$GLOBALS['TSFE']->register['imagewidth']  = $this->conf['imagewidth'];
		$GLOBALS['TSFE']->register['imageheight'] = $this->conf['imageheight'];
		$GLOBALS['TSFE']->register['IMAGE_NUM_CURRENT'] = 0;
		$GLOBALS['TSFE']->register['showcaption'] = $this->conf['showcaption'];
		if (count($data) > 0) {
			foreach ($data as $key => $item) {
				$image = null;
				$imgConf = $this->conf['cycle.'][$this->type.'.']['image.'];
				$totalImagePath = $dir . $item['image'];
				$GLOBALS['TSFE']->register['file']    = $totalImagePath;
				$GLOBALS['TSFE']->register['href']    = $item['href'];
				$GLOBALS['TSFE']->register['caption'] = $item['caption'];
				if ($this->hrefs[$key]) {
					$imgConf['imageLinkWrap.'] = $imgConf['imageHrefWrap.'];
				} else {
					$link = $this->cObj->imageLinkWrap('', $totalImagePath, $imgConf['imageLinkWrap.']);
					if ($link) {
						unset($imgConf['titleText']);
						unset($imgConf['titleText.']);
						$imgConf['emptyTitleHandling'] = 'removeAttr';
					}
				}
				$image = $this->cObj->IMAGE($imgConf);
				$image = $this->cObj->typolink($image, $imgConf['imageLinkWrap.']);
				if ($item['caption'] && $this->conf['showcaption']) {
					$image = $this->cObj->stdWrap($image, $this->conf['cycle.'][$this->type.'.']['captionWrap.']);
				}
				$image = $this->cObj->stdWrap($image, $this->conf['cycle.'][$this->type.'.']['itemWrap.']);
				$images .= $image;
				$GLOBALS['TSFE']->register['IMAGE_NUM_CURRENT'] ++;
			}
			$return_string = $this->cObj->stdWrap($images, $this->conf['cycle.'][$this->type.'.']['stdWrap.']);
		}
		return $return_string;
	}

	/**
	 * Include all defined resources (JS / CSS)
	 *
	 * @return void
	 */
	function addResources() {
		// checks if t3jquery is loaded
		if (T3JQUERY === true) {
			tx_t3jquery::addJqJS();
		} else {
			$this->addJsFile($this->conf['jQueryLibrary'], true);
			$this->addJsFile($this->conf['jQueryEasing']);
		}
		// add all defined JS files
		if (count($this->jsFiles) > 0) {
			foreach ($this->jsFiles as $jsToLoad) {
				// Add script only once
				if (! preg_match("/".preg_quote($this->getPath($jsToLoad), "/")."/", $GLOBALS['TSFE']->additionalHeaderData['jsFile_'.$this->extKey])) {
					$GLOBALS['TSFE']->additionalHeaderData['jsFile_'.$this->extKey] .= ($this->getPath($jsToLoad) ? '<script src="'.$this->getPath($jsToLoad).'" type="text/javascript"></script>'.chr(10) :'');
				}
			}
		}
		// add all defined JS Script
		if (count($this->js) > 0) {
			foreach ($this->js as $jsToPut) {
				$temp_js .= $jsToPut;
			}
			if ($this->conf['jsInFooter']) {
				$GLOBALS['TSFE']->additionalFooterData['js_'.$this->extKey] .= t3lib_div::wrapJS($temp_js, true);
			} else {
				$GLOBALS['TSFE']->additionalHeaderData['js_'.$this->extKey] .= t3lib_div::wrapJS($temp_js, true);
			}
		}
		// add all defined CSS files
		if (count($this->cssFiles) > 0) {
			foreach ($this->cssFiles as $cssToLoad) {
				// Add script only once
				if (! preg_match("/".preg_quote($this->getPath($cssToLoad), "/")."/", $GLOBALS['TSFE']->additionalHeaderData['cssFile_'.$this->extKey])) {
					$GLOBALS['TSFE']->additionalHeaderData['cssFile_'.$this->extKey] .= ($this->getPath($cssToLoad) ? '<link rel="stylesheet" href="'.$this->getPath($cssToLoad).'" type="text/css" />'.chr(10) :'');
				}
			}
		}
		// add all defined CSS Script
		if (count($this->css) > 0) {
			foreach ($this->css as $cssToPut) {
				$temp_css .= $cssToPut;
			}
			$GLOBALS['TSFE']->additionalHeaderData['css_'.$this->extKey] .= '
<style type="text/css">
' . $temp_css . '
</style>';
		}
	}

	/**
	 * Return the webbased path
	 * 
	 * @param string $path
	 * return string
	 */
	function getPath($path="")
	{
		return $GLOBALS['TSFE']->tmpl->getFileName($path);
	}

	/**
	 * Add additional JS file
	 * 
	 * @param string $script
	 * @param boolean $first
	 * @return void
	 */
	function addJsFile($script="", $first=false)
	{
		$script = t3lib_div::fixWindowsFilePath($script);
		if ($this->getPath($script) && ! in_array($script, $this->jsFiles)) {
			if ($first === true) {
				$this->jsFiles = array_merge(array($script), $this->jsFiles);
			} else {
				$this->jsFiles[] = $script;
			}
		}
	}

	/**
	 * Add JS to header
	 * 
	 * @param string $script
	 * @return void
	 */
	function addJS($script="")
	{
		if (! in_array($script, $this->js)) {
			$this->js[] = $script;
		}
	}

	/**
	 * Add additional CSS file
	 * 
	 * @param string $script
	 * @return void
	 */
	function addCssFile($script="")
	{
		$script = t3lib_div::fixWindowsFilePath($script);
		if ($this->getPath($script) && ! in_array($script, $this->cssFiles)) {
			$this->cssFiles[] = $script;
		}
	}

	/**
	 * Add CSS to header
	 * 
	 * @param string $script
	 * @return void
	 */
	function addCSS($script="")
	{
		if (! in_array($script, $this->css)) {
			$this->css[] = $script;
		}
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/imagecycle/pi1/class.tx_imagecycle_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/imagecycle/pi1/class.tx_imagecycle_pi1.php']);
}

?>
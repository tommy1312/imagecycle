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
class tx_imagecycle_pi1 extends tslib_pibase {
	var $prefixId      = 'tx_imagecycle_pi1';		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_imagecycle_pi1.php';	// Path to this script relative to the extension dir.
	var $extKey        = 'imagecycle';	// The extension key.
	var $pi_checkCHash = true;
	var $lConf = array();
	var $templateFile = null;
	var $contentKey = null;
	var $jsFiles = array();
	var $js = array();
	var $cssFiles = array();
	var $css = array();
	var $images = array();
	var $hrefs = array();
	var $captions = array();
	var $imageDir = 'uploads/tx_imagecycle/';

	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	function main($content, $conf) {
		$this->conf = $conf;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();

		// define the key of the element
		$this->contentKey = "imagecycle";

		$pageID = false;
		if ($this->cObj->data['list_type'] == $this->extKey.'_pi1') {
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
				$this->images = t3lib_div::trimExplode(',', $this->lConf['images']);
			}
			// define the hrefs
			if ($this->lConf['hrefs']) {
				$this->hrefs = t3lib_div::trimExplode(chr(10), $this->lConf['hrefs']);
			}
			// define the captions
			if ($this->lConf['captions'] && $this->lConf['showcaption']) {
				$this->captions = t3lib_div::trimExplode(chr(10), $this->lConf['captions']);
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
			$this->conf['stopOnMousover'] = $this->lConf['stoponmousover'];
			$this->conf['sync'] = $this->lConf['sync'];
			$this->conf['random'] = $this->lConf['random'];
			$this->conf['options'] = $this->lConf['options'];
		} else {
			// It's the header
			foreach ($GLOBALS['TSFE']->rootLine as $page) {
				if ($page['tx_imagecycle_stoprecursion']) {
					break;
				}
				if (trim($page['tx_imagecycle_images']) != '' || $this->conf['disableRecursion']) {
					$this->images   = t3lib_div::trimExplode(',', $page['tx_imagecycle_images']);
					$this->hrefs    = t3lib_div::trimExplode(chr(10), $page['tx_imagecycle_hrefs']);
					$this->captions = t3lib_div::trimExplode(chr(10), $page['tx_imagecycle_captions']);
					$pageID  = $page['uid'];
					break;
				}
			}
			if ($pageID && $GLOBALS['TSFE']->sys_language_content) {
				$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('tx_imagecycle_images, tx_imagecycle_hrefs, tx_imagecycle_captions','pages_language_overlay','pid='.intval($pageID).' AND sys_language_uid='.$GLOBALS['TSFE']->sys_language_content,'','',1);
				$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
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
			$data[$key]['caption'] = $this->captions[$key];
		}

		return $this->pi_wrapInBaseClass($this->parseTemplate($data));
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
		if (count($data) == 0) {
			return false;
		}

		// define the contentKey if not exist
		if ($this->contentKey == '') {
			$this->contentKey = "imagecycle_key";
		}

		// define the jQuery mode and function
		if ($this->conf['jQueryNoConflict']) {
			$jQueryNoConflict = "jQuery.noConflict();";
			$jQuery = "jQuery";
		} else {
			$jQueryNoConflict = "";
			$jQuery = "$";
		}

		// The template
		if ($this->conf['templateFile']) {
			$this->templateFile = $this->cObj->fileResource($this->conf['templateFile']);
		} else {
			return "<p>NO TEMPLATE FOUND!</p>";
		}

		// get the options from flexform
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

		// add the CSS file
		$this->addCssFile($this->conf['cssFile']);

		// define the js files
		$this->addJsFile("EXT:imagecycle/res/jquery/js/jquery.cycle.all.min.js");

		$this->addJS(
$jQueryNoConflict . "
{$jQuery}(document).ready(function() {
	{$jQuery}('#{$this->contentKey}').cycle(".(count($options) ? "{\n		".implode(",\n		", $options)."\n	}" : "").");
});");

		preg_match("/^([0-9]*)/i", $this->conf['imagewidth'], $reg_width);
		preg_match("/^([0-9]*)/i", $this->conf['imageheight'], $reg_height);

		// Add the ressources
		$this->addResources();

		if ($onlyJS === true) {
			return true;
		}

		$return_string = null;
		// Render the Template
		$markerArray = array();
		// get the template
		$templateCode = $this->cObj->getSubpart($this->templateFile, "###TEMPLATE_CYCLE###");
		// Get the images template
		$imagesCode = $this->cObj->getSubpart($templateCode, "###IMAGES###");
		// Replace default values
		$markerArray["KEY"] = $this->contentKey;
		$templateCode = $this->cObj->substituteMarkerArray($templateCode, $markerArray, '###|###', 0);
		if (count($data) > 0) {
			foreach ($data as $key => $item) {
				$markerArray = array();
				$image_config = array();
				// render the image to the gifen size
				$image_config['img'] = 'IMAGE';
				if (! $item['href']) {
					$image_config['img.'] = $GLOBALS['TSFE']->tmpl->setup['tt_content.']['image.']['20.']['1.'];
					unset($image_config['img.']['file.']['import.']);
					unset($image_config['img.']['altText.']);
					unset($image_config['img.']['titleText.']);
					unset($image_config['img.']['file.']['width.']);
				}
				$image_config['img.']['file'] = $dir . $item['image'];
				$image_config['img.']['file.']['width']  = $this->conf['imagewidth'];
				$image_config['img.']['file.']['height'] = $this->conf['imageheight'];
				$image_config['img.']['altText'] = $item['caption'];
				$image_config['img.']['altText.']['stripHtml'] = 1;
				$image_config['img.']['titleText'] = $item['caption'];
				$image_config['img.']['titleText.']['stripHtml'] = 1;
				$image = $this->cObj->IMAGE($image_config['img.']);
				if ($item['href']) {
					$link_config = array(
						'parameter' => $item['href'],
						'title'     => $item['caption'],
						'target'    => $this->conf['linkTarget'],
						'extTarget' => $this->conf['extlinkTarget']
					);
					$markerArray["IMAGE"] = $this->cObj->typolink($image, $link_config);
				} else {
					$markerArray["IMAGE"] = $image;
				}
				$images .= $this->cObj->substituteMarkerArray($imagesCode, $markerArray, '###|###', 0);
			}
			$return_string = $templateCode;
			$return_string = $this->cObj->substituteSubpart($return_string, '###IMAGES###', $images, 0);
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
			$this->addJsFile("EXT:imagecycle/res/jquery/js/jquery.easing-1.3.js");
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
			$GLOBALS['TSFE']->additionalHeaderData['js_'.$this->extKey] .= t3lib_div::wrapJS($temp_js, true);
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
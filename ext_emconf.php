<?php

########################################################################
# Extension Manager/Repository config file for ext "imagecycle".
#
# Auto generated 14-08-2011 23:47
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Image Cycle',
	'description' => 'Insert a slideshow into your page or template. Manage the images, captions and hrefs recursively in the pagetree and show it in a jQuery-Cycle, Coin-Slider, Nivo-Slider or Cross-Slider. Add media from DAM and DAM-Category. Use t3jquery for better integration with other jQuery extensions.',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '2.2.2',
	'dependencies' => 'cms,jftcaforms',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => 'uploads/tx_imagecycle',
	'modify_tables' => '',
	'clearcacheonload' => 1,
	'lockType' => '',
	'author' => 'Juergen Furrer',
	'author_email' => 'juergen.furrer@gmail.com',
	'author_company' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'php' => '5.0.0-0.0.0',
			'typo3' => '4.3.0-4.99.999',
			'jftcaforms' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:84:{s:20:"class.ext_update.php";s:4:"8777";s:23:"class.tx_imagecycle.php";s:4:"3eed";s:21:"ext_conf_template.txt";s:4:"4464";s:12:"ext_icon.gif";s:4:"7990";s:17:"ext_localconf.php";s:4:"a3de";s:14:"ext_tables.php";s:4:"b0ea";s:14:"ext_tables.sql";s:4:"a00c";s:13:"locallang.xml";s:4:"0a54";s:16:"locallang_db.xml";s:4:"c255";s:12:"mode_dam.gif";s:4:"999b";s:15:"mode_damcat.gif";s:4:"2596";s:15:"mode_folder.gif";s:4:"9d05";s:12:"mode_rte.gif";s:4:"2ded";s:15:"mode_upload.gif";s:4:"fecd";s:12:"t3jquery.txt";s:4:"8847";s:24:"compat/flashmessages.css";s:4:"4e2c";s:20:"compat/gfx/error.png";s:4:"e4dd";s:26:"compat/gfx/information.png";s:4:"3750";s:21:"compat/gfx/notice.png";s:4:"a882";s:17:"compat/gfx/ok.png";s:4:"8bfe";s:22:"compat/gfx/warning.png";s:4:"c847";s:14:"doc/manual.sxw";s:4:"6d2c";s:35:"lib/class.tx_imagecycle_TCAform.php";s:4:"0b4d";s:38:"lib/class.tx_imagecycle_cms_layout.php";s:4:"5301";s:41:"lib/class.tx_imagecycle_itemsProcFunc.php";s:4:"ff3b";s:35:"lib/class.tx_imagecycle_tceFunc.php";s:4:"d7bd";s:39:"lib/class.tx_imagecycle_tsparserext.php";s:4:"e33a";s:15:"pi1/ce_icon.gif";s:4:"7990";s:14:"pi1/ce_wiz.gif";s:4:"7667";s:31:"pi1/class.tx_imagecycle_pi1.php";s:4:"92e6";s:39:"pi1/class.tx_imagecycle_pi1_wizicon.php";s:4:"fd95";s:19:"pi1/flexform_ds.xml";s:4:"6700";s:17:"pi1/locallang.xml";s:4:"14d7";s:15:"pi2/ce_icon.gif";s:4:"a304";s:14:"pi2/ce_wiz.gif";s:4:"18be";s:31:"pi2/class.tx_imagecycle_pi2.php";s:4:"8057";s:39:"pi2/class.tx_imagecycle_pi2_wizicon.php";s:4:"96a9";s:19:"pi2/flexform_ds.xml";s:4:"eeb5";s:17:"pi2/locallang.xml";s:4:"d45c";s:15:"pi3/ce_icon.gif";s:4:"fe29";s:14:"pi3/ce_wiz.gif";s:4:"8c4b";s:31:"pi3/class.tx_imagecycle_pi3.php";s:4:"8118";s:39:"pi3/class.tx_imagecycle_pi3_wizicon.php";s:4:"2c46";s:19:"pi3/flexform_ds.xml";s:4:"b309";s:17:"pi3/locallang.xml";s:4:"f0fd";s:15:"pi4/ce_icon.gif";s:4:"d9d5";s:14:"pi4/ce_wiz.gif";s:4:"d451";s:31:"pi4/class.tx_imagecycle_pi4.php";s:4:"035a";s:39:"pi4/class.tx_imagecycle_pi4_wizicon.php";s:4:"2698";s:19:"pi4/flexform_ds.xml";s:4:"d21c";s:17:"pi4/locallang.xml";s:4:"4b70";s:20:"res/tx_imagecycle.js";s:4:"a396";s:17:"res/css/style.css";s:4:"130d";s:28:"res/css/nivoslider/style.css";s:4:"3039";s:36:"res/css/nivoslider/images/arrows.png";s:4:"09b2";s:37:"res/css/nivoslider/images/bullets.png";s:4:"4f6b";s:37:"res/css/nivoslider/images/loading.gif";s:4:"95b2";s:28:"res/img/controller-first.gif";s:4:"f421";s:27:"res/img/controller-last.gif";s:4:"11ea";s:27:"res/img/controller-next.gif";s:4:"2eec";s:28:"res/img/controller-pause.gif";s:4:"afd4";s:27:"res/img/controller-prev.gif";s:4:"8965";s:22:"res/img/controller.png";s:4:"6873";s:33:"res/jquery/js/jquery-1.6.2.min.js";s:4:"a1a8";s:40:"res/jquery/js/jquery.coinslider-1.0.a.js";s:4:"921a";s:44:"res/jquery/js/jquery.coinslider-1.0.a.min.js";s:4:"2b41";s:44:"res/jquery/js/jquery.crossslide-0.6.2.min.js";s:4:"4ec5";s:40:"res/jquery/js/jquery.cycle.all-2.9994.js";s:4:"1dcc";s:44:"res/jquery/js/jquery.cycle.all-2.9994.min.js";s:4:"033a";s:40:"res/jquery/js/jquery.cycle.all-2.9995.js";s:4:"3d87";s:44:"res/jquery/js/jquery.cycle.all-2.9995.min.js";s:4:"1c5c";s:34:"res/jquery/js/jquery.easing-1.3.js";s:4:"6516";s:39:"res/jquery/js/jquery.nivoslider-2.60.js";s:4:"f3a9";s:43:"res/jquery/js/jquery.nivoslider-2.60.min.js";s:4:"1af5";s:20:"static/constants.txt";s:4:"e041";s:16:"static/setup.txt";s:4:"d858";s:31:"static/coinslider/constants.txt";s:4:"9bd5";s:27:"static/coinslider/setup.txt";s:4:"aa64";s:31:"static/crossslide/constants.txt";s:4:"ac53";s:27:"static/crossslide/setup.txt";s:4:"8229";s:31:"static/nivoslider/constants.txt";s:4:"a1a9";s:27:"static/nivoslider/setup.txt";s:4:"073a";s:27:"static/tt_content/setup.txt";s:4:"1717";s:24:"static/tt_news/setup.txt";s:4:"6f37";}',
	'suggests' => array(
	),
);

?>
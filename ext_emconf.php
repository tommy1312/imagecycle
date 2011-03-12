<?php

########################################################################
# Extension Manager/Repository config file for ext "imagecycle".
#
# Auto generated 12-03-2011 02:07
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Image Cycle',
	'description' => 'Insert a slideshow into your page or template. Manage the images, captions and hrefs recursively in the pagetree and show it in a jQuery Cycle. Add media from DAM and DAM-Category. Use t3jquery for better integration with other jQuery extensions.',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '1.9.0',
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
			'php' => '5.0.0-5.3.99',
			'typo3' => '4.3.0-4.5.99',
			'jftcaforms' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:91:{s:23:"class.tx_imagecycle.php";s:4:"1323";s:21:"ext_conf_template.txt";s:4:"b8a2";s:12:"ext_icon.gif";s:4:"7990";s:17:"ext_localconf.php";s:4:"a3de";s:14:"ext_tables.php";s:4:"44ec";s:14:"ext_tables.sql";s:4:"b243";s:13:"locallang.xml";s:4:"db0e";s:16:"locallang_db.xml";s:4:"fe55";s:12:"mode_dam.gif";s:4:"999b";s:15:"mode_damcat.gif";s:4:"2596";s:15:"mode_folder.gif";s:4:"9d05";s:12:"mode_rte.gif";s:4:"2ded";s:15:"mode_upload.gif";s:4:"fecd";s:12:"t3jquery.txt";s:4:"8847";s:24:"compat/flashmessages.css";s:4:"4e2c";s:20:"compat/gfx/error.png";s:4:"e4dd";s:26:"compat/gfx/information.png";s:4:"3750";s:21:"compat/gfx/notice.png";s:4:"a882";s:17:"compat/gfx/ok.png";s:4:"8bfe";s:22:"compat/gfx/warning.png";s:4:"c847";s:14:"doc/manual.sxw";s:4:"b0dc";s:35:"lib/class.tx_imagecycle_TCAform.php";s:4:"1af1";s:38:"lib/class.tx_imagecycle_cms_layout.php";s:4:"6ab4";s:41:"lib/class.tx_imagecycle_itemsProcFunc.php";s:4:"1065";s:35:"lib/class.tx_imagecycle_tceFunc.php";s:4:"1094";s:39:"lib/class.tx_imagecycle_tsparserext.php";s:4:"2f2a";s:14:"pi1/ce_wiz.gif";s:4:"7667";s:31:"pi1/class.tx_imagecycle_pi1.php";s:4:"02a0";s:39:"pi1/class.tx_imagecycle_pi1_wizicon.php";s:4:"fd95";s:19:"pi1/flexform_ds.xml";s:4:"fc62";s:17:"pi1/locallang.xml";s:4:"14d7";s:14:"pi2/ce_wiz.gif";s:4:"18be";s:31:"pi2/class.tx_imagecycle_pi2.php";s:4:"c958";s:39:"pi2/class.tx_imagecycle_pi2_wizicon.php";s:4:"96a9";s:19:"pi2/flexform_ds.xml";s:4:"3d85";s:17:"pi2/locallang.xml";s:4:"9f6a";s:14:"pi3/ce_wiz.gif";s:4:"8c4b";s:31:"pi3/class.tx_imagecycle_pi3.php";s:4:"81de";s:39:"pi3/class.tx_imagecycle_pi3_wizicon.php";s:4:"2c46";s:19:"pi3/flexform_ds.xml";s:4:"aafe";s:17:"pi3/locallang.xml";s:4:"42e7";s:14:"pi4/ce_wiz.gif";s:4:"d451";s:31:"pi4/class.tx_imagecycle_pi4.php";s:4:"b351";s:39:"pi4/class.tx_imagecycle_pi4_wizicon.php";s:4:"2698";s:19:"pi4/flexform_ds.xml";s:4:"bd72";s:17:"pi4/locallang.xml";s:4:"4b70";s:20:"res/tx_imagecycle.js";s:4:"033b";s:17:"res/css/style.css";s:4:"0dc0";s:34:"res/css/nivoslider/nivo-slider.css";s:4:"51a5";s:28:"res/css/nivoslider/style.css";s:4:"7094";s:36:"res/css/nivoslider/images/arrows.png";s:4:"09b2";s:40:"res/css/nivoslider/images/background.png";s:4:"d4b3";s:37:"res/css/nivoslider/images/bullets.png";s:4:"4f6b";s:38:"res/css/nivoslider/images/dev7logo.png";s:4:"0306";s:37:"res/css/nivoslider/images/loading.gif";s:4:"95b2";s:34:"res/css/nivoslider/images/nemo.jpg";s:4:"7ea9";s:36:"res/css/nivoslider/images/slider.png";s:4:"e89d";s:38:"res/css/nivoslider/images/toystory.jpg";s:4:"7843";s:32:"res/css/nivoslider/images/up.jpg";s:4:"97a8";s:35:"res/css/nivoslider/images/walle.jpg";s:4:"0e44";s:28:"res/img/controller-first.gif";s:4:"f421";s:27:"res/img/controller-last.gif";s:4:"11ea";s:27:"res/img/controller-next.gif";s:4:"2eec";s:28:"res/img/controller-pause.gif";s:4:"afd4";s:27:"res/img/controller-prev.gif";s:4:"8965";s:22:"res/img/controller.png";s:4:"6873";s:33:"res/jquery/js/jquery-1.3.2.min.js";s:4:"bb38";s:33:"res/jquery/js/jquery-1.4.0.min.js";s:4:"9e93";s:33:"res/jquery/js/jquery-1.4.1.min.js";s:4:"0d40";s:33:"res/jquery/js/jquery-1.4.2.min.js";s:4:"1009";s:33:"res/jquery/js/jquery-1.4.3.min.js";s:4:"e495";s:33:"res/jquery/js/jquery-1.4.4.min.js";s:4:"73a9";s:33:"res/jquery/js/jquery-1.5.0.min.js";s:4:"63c1";s:33:"res/jquery/js/jquery-1.5.1.min.js";s:4:"b04a";s:42:"res/jquery/js/jquery.coinslider-1.0.min.js";s:4:"4c53";s:44:"res/jquery/js/jquery.crossslide-0.6.2.min.js";s:4:"4ec5";s:42:"res/jquery/js/jquery.cycle.all-2.80.min.js";s:4:"0975";s:42:"res/jquery/js/jquery.cycle.all-2.86.min.js";s:4:"d52e";s:42:"res/jquery/js/jquery.cycle.all-2.88.min.js";s:4:"c36e";s:42:"res/jquery/js/jquery.cycle.all-2.94.min.js";s:4:"551b";s:42:"res/jquery/js/jquery.cycle.all-2.97.min.js";s:4:"5e82";s:34:"res/jquery/js/jquery.easing-1.3.js";s:4:"6516";s:44:"res/jquery/js/jquery.nivoslider-2.40.pack.js";s:4:"78b2";s:20:"static/constants.txt";s:4:"538b";s:16:"static/setup.txt";s:4:"2ccb";s:31:"static/coinslider/constants.txt";s:4:"4a0f";s:27:"static/coinslider/setup.txt";s:4:"4946";s:31:"static/crossslide/constants.txt";s:4:"378e";s:27:"static/crossslide/setup.txt";s:4:"4b06";s:31:"static/nivoslider/constants.txt";s:4:"3f80";s:27:"static/nivoslider/setup.txt";s:4:"b400";}',
	'suggests' => array(
	),
);

?>
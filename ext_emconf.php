<?php

########################################################################
# Extension Manager/Repository config file for ext "imagecycle".
#
# Auto generated 27-12-2010 01:45
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Image Cycle',
	'description' => 'Insert a slideshow into your page or template. Manage the images, captions and hrefs recursively in the pagetree and show it in a jQuery Cycle. Add media from DAM and DAM-Category. Use t3jquery for better integration with other jQuery extensions.',
	'category' => 'plugin',
	'author' => 'Juergen Furrer',
	'author_email' => 'juergen.furrer@gmail.com',
	'shy' => '',
	'dependencies' => 'cms',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => 'uploads/tx_imagecycle',
	'modify_tables' => '',
	'clearCacheOnLoad' => 1,
	'lockType' => '',
	'author_company' => '',
	'version' => '1.6.0',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'php' => '5.0.0-5.3.99',
			'typo3' => '4.3.0-4.4.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:51:{s:23:"class.tx_imagecycle.php";s:4:"1323";s:21:"ext_conf_template.txt";s:4:"518a";s:12:"ext_icon.gif";s:4:"7990";s:17:"ext_localconf.php";s:4:"c37a";s:14:"ext_tables.php";s:4:"7af6";s:14:"ext_tables.sql";s:4:"b243";s:15:"flexform_ds.xml";s:4:"ae9d";s:13:"locallang.xml";s:4:"7d96";s:16:"locallang_db.xml";s:4:"765f";s:12:"mode_dam.gif";s:4:"999b";s:15:"mode_damcat.gif";s:4:"2596";s:15:"mode_folder.gif";s:4:"9d05";s:12:"mode_rte.gif";s:4:"2ded";s:15:"mode_upload.gif";s:4:"fecd";s:12:"t3jquery.txt";s:4:"8847";s:24:"compat/flashmessages.css";s:4:"4e2c";s:20:"compat/gfx/error.png";s:4:"e4dd";s:26:"compat/gfx/information.png";s:4:"3750";s:21:"compat/gfx/notice.png";s:4:"a882";s:17:"compat/gfx/ok.png";s:4:"8bfe";s:22:"compat/gfx/warning.png";s:4:"c847";s:14:"doc/manual.sxw";s:4:"a339";s:35:"lib/class.tx_imagecycle_TCAform.php";s:4:"1af1";s:38:"lib/class.tx_imagecycle_cms_layout.php";s:4:"68bb";s:41:"lib/class.tx_imagecycle_itemsProcFunc.php";s:4:"3924";s:35:"lib/class.tx_imagecycle_tceFunc.php";s:4:"1094";s:39:"lib/class.tx_imagecycle_tsparserext.php";s:4:"763c";s:14:"pi1/ce_wiz.gif";s:4:"7667";s:31:"pi1/class.tx_imagecycle_pi1.php";s:4:"7c2b";s:39:"pi1/class.tx_imagecycle_pi1_wizicon.php";s:4:"fd95";s:17:"pi1/locallang.xml";s:4:"14d7";s:24:"res/tx_imagecycle_pi1.js";s:4:"a225";s:17:"res/css/style.css";s:4:"0dc0";s:28:"res/img/controller-first.gif";s:4:"f421";s:27:"res/img/controller-last.gif";s:4:"11ea";s:27:"res/img/controller-next.gif";s:4:"2eec";s:28:"res/img/controller-pause.gif";s:4:"afd4";s:27:"res/img/controller-prev.gif";s:4:"8965";s:22:"res/img/controller.png";s:4:"6873";s:33:"res/jquery/js/jquery-1.3.2.min.js";s:4:"bb38";s:33:"res/jquery/js/jquery-1.4.0.min.js";s:4:"9e93";s:33:"res/jquery/js/jquery-1.4.1.min.js";s:4:"0d40";s:33:"res/jquery/js/jquery-1.4.2.min.js";s:4:"1009";s:33:"res/jquery/js/jquery-1.4.3.min.js";s:4:"e495";s:33:"res/jquery/js/jquery-1.4.4.min.js";s:4:"73a9";s:42:"res/jquery/js/jquery.cycle.all-2.80.min.js";s:4:"0975";s:42:"res/jquery/js/jquery.cycle.all-2.86.min.js";s:4:"d52e";s:42:"res/jquery/js/jquery.cycle.all-2.88.min.js";s:4:"c36e";s:34:"res/jquery/js/jquery.easing-1.3.js";s:4:"6516";s:20:"static/constants.txt";s:4:"900d";s:16:"static/setup.txt";s:4:"a16c";}',
	'suggests' => array(
	),
);

?>
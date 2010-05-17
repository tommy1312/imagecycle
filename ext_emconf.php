<?php

########################################################################
# Extension Manager/Repository config file for ext "imagecycle".
#
# Auto generated 17-05-2010 20:24
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
	'version' => '1.0.4',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'php' => '5.0.0-5.3.99',
			'typo3' => '4.1.0-4.3.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:30:{s:23:"class.tx_imagecycle.php";s:4:"86ee";s:21:"ext_conf_template.txt";s:4:"af60";s:12:"ext_icon.gif";s:4:"7990";s:17:"ext_localconf.php";s:4:"f657";s:14:"ext_tables.php";s:4:"4617";s:14:"ext_tables.sql";s:4:"b1b3";s:15:"flexform_ds.xml";s:4:"a58d";s:13:"locallang.xml";s:4:"5ce3";s:16:"locallang_db.xml";s:4:"26f3";s:12:"mode_dam.gif";s:4:"999b";s:15:"mode_damcat.gif";s:4:"2596";s:15:"mode_folder.gif";s:4:"9d05";s:15:"mode_upload.gif";s:4:"fecd";s:12:"t3jquery.txt";s:4:"8766";s:14:"doc/manual.sxw";s:4:"e21e";s:41:"lib/class.tx_imagecycle_itemsProcFunc.php";s:4:"1062";s:14:"pi1/ce_wiz.gif";s:4:"7667";s:31:"pi1/class.tx_imagecycle_pi1.php";s:4:"36dd";s:39:"pi1/class.tx_imagecycle_pi1_wizicon.php";s:4:"2e15";s:17:"pi1/locallang.xml";s:4:"14d7";s:33:"res/jquery/js/jquery-1.3.2.min.js";s:4:"bb38";s:33:"res/jquery/js/jquery-1.4.0.min.js";s:4:"9e93";s:33:"res/jquery/js/jquery-1.4.1.min.js";s:4:"0d40";s:33:"res/jquery/js/jquery-1.4.2.min.js";s:4:"1009";s:42:"res/jquery/js/jquery.cycle.all.min-2.75.js";s:4:"d398";s:42:"res/jquery/js/jquery.cycle.all.min-2.80.js";s:4:"0975";s:42:"res/jquery/js/jquery.cycle.all.min-2.86.js";s:4:"d52e";s:34:"res/jquery/js/jquery.easing-1.3.js";s:4:"6516";s:20:"static/constants.txt";s:4:"e72b";s:16:"static/setup.txt";s:4:"7095";}',
	'suggests' => array(
	),
);

?>
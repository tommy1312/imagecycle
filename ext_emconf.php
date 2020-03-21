<?php
$EM_CONF[$_EXTKEY] = array(
	'title' => 'Image Cycle',
	'description' => 'Insert a slideshow into your page or template. Manage the images, captions and hrefs recursively in the pagetree and show it in a jQuery-Cycle, Coin-Slider, Nivo-Slider or Cross-Slider.',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '9.5.2',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => 0,
	'createDirs' => 'uploads/tx_imagecycle',
	'modify_tables' => '',
	'clearcacheonload' => 1,
	'lockType' => '',
	'author' => 'Franz Holzinger, Juergen Furrer',
	'author_email' => 'franz@ttproducts.de',
	'author_company' => '',
	'constraints' => array(
		'depends' => array(
			'php' => '7.00.00-7.4.99',
			'typo3' => '8.7.0-9.5.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
            'lib_jquery' => '2.1.0-0.0.0',
		),
	),
	'autoload' => array(
		'psr-4' => array(
			'TYPO3Extension\\Imagecycle\\' => 'Classes',
		),
	),
);

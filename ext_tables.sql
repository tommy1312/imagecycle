#
# Table structure for table 'pages'
#
CREATE TABLE pages (
	tx_imagecycle_mode varchar(20) DEFAULT '' NOT NULL,
	tx_imagecycle_damimages varchar(20) DEFAULT '' NOT NULL,
	tx_imagecycle_damcategories varchar(20) DEFAULT '' NOT NULL,
	tx_imagecycle_images text,
	tx_imagecycle_hrefs text,
	tx_imagecycle_captions text,
	tx_imagecycle_stoprecursion tinyint(3) DEFAULT '0' NOT NULL,
	tx_imagecycle_effect varchar(20) DEFAULT '' NOT NULL
);



#
# Table structure for table 'pages_language_overlay'
#
CREATE TABLE pages_language_overlay (
	tx_imagecycle_mode varchar(20) DEFAULT '' NOT NULL,
	tx_imagecycle_damimages varchar(20) DEFAULT '' NOT NULL,
	tx_imagecycle_damcategories varchar(20) DEFAULT '' NOT NULL,
	tx_imagecycle_images text,
	tx_imagecycle_hrefs text,
	tx_imagecycle_captions text,
	tx_imagecycle_stoprecursion tinyint(3) DEFAULT '0' NOT NULL,
	tx_imagecycle_effect varchar(20) DEFAULT '' NOT NULL
);



#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
	tx_imagecycle_activate tinyint(3) DEFAULT '0' NOT NULL,
	tx_imagecycle_duration int(11) DEFAULT '0' NOT NULL
);



#
# Table structure for table 'tt_news'
#
CREATE TABLE tt_news (
	tx_imagecycle_activate tinyint(3) DEFAULT '0' NOT NULL,
	tx_imagecycle_duration int(11) DEFAULT '0' NOT NULL
);



#
# Table structure for table 'tx_dam'
#
CREATE TABLE tx_dam (
	tx_jfdam_link varchar(255) DEFAULT '' NOT NULL
);

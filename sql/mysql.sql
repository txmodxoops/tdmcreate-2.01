#Copyright © TDMCreate Module for Xoops (http://www.xoops.org)
#Copyright © TXMod Xoops (http://www.txmodxoops.org)
#
#Revision 0058
#$Id Timgno <info@txmodxoops.org>

#
# Table structure for table `tdmcreate_modules` 31
#
		
CREATE TABLE `tdmcreate_modules` (
`mod_id` int (5) unsigned NOT NULL auto_increment,
`mod_name` varchar (255) NOT NULL default '',
`mod_isextension` tinyint (1) unsigned NOT NULL default '0',
`mod_version` char (5) NOT NULL default '1.00',
`mod_description` text NOT NULL ,
`mod_author` varchar (100) NOT NULL default '',
`mod_author_mail` varchar (200) NOT NULL default '',
`mod_author_website_url` varchar (255) NOT NULL default 'http://',
`mod_author_website_name` varchar (255) NOT NULL default '',
`mod_credits` varchar (255) NOT NULL default '',
`mod_license` varchar (100) NOT NULL default '',
`mod_release_info` varchar (100) NOT NULL default '',
`mod_release_file` varchar (100) NOT NULL default '',
`mod_manual` varchar (255) NOT NULL default '',
`mod_manual_file` varchar (255) NOT NULL default '',
`mod_image` varchar (50) NOT NULL default '',
`mod_demo_site_url` varchar (255) NOT NULL default 'http://',
`mod_demo_site_name` varchar (255) NOT NULL default '',
`mod_support_url` varchar (255) NOT NULL default 'http://',
`mod_support_name` varchar (255) NOT NULL default '',
`mod_website_url` varchar (255) NOT NULL default 'http://',
`mod_website_name` varchar (255) NOT NULL default '',
`mod_release` varchar (11) NOT NULL default '',
`mod_status` varchar (100) NOT NULL default '',
`mod_admin` tinyint (1) unsigned NOT NULL default '0',
`mod_user` tinyint (1) unsigned NOT NULL default '0',
`mod_submenu` tinyint (1) unsigned NOT NULL default '0',
`mod_search` tinyint (1) unsigned NOT NULL default '0',
`mod_comments` tinyint (1) unsigned NOT NULL default '0',
`mod_notifications` tinyint (1) unsigned NOT NULL default '0', 
`mod_paypal` varchar (20) NOT NULL default 'YDRUY5QZQHAHS',
`mod_subversion` varchar (10) NOT NULL default '000000',
PRIMARY KEY (`mod_id`),
KEY `mod_name` (`mod_name`(40))
) ENGINE=MyISAM;

#
# Table structure for table `tdmcreate_tables` 13
#
		
CREATE TABLE `tdmcreate_tables` (
`table_id` int (5) unsigned NOT NULL auto_increment,
`table_mid` int (5) unsigned NOT NULL default '0',
`table_name` varchar (255) NOT NULL default '',
`table_nbfields` int (5) unsigned NOT NULL default '0',
`table_fieldname` varchar (50) NOT NULL default '',
`table_image` varchar (100) NOT NULL default '',
`table_blocks` tinyint (1) unsigned NOT NULL default '0',
`table_admin` tinyint (1) unsigned NOT NULL default '0',
`table_user` tinyint (1) unsigned NOT NULL default '0',
`table_submenu` tinyint (1) unsigned NOT NULL default '0',
`table_search` tinyint (1) unsigned NOT NULL default '0',
`table_comments` tinyint (1) unsigned NOT NULL default '0',
`table_notifications` tinyint (1) unsigned NOT NULL default '0',
PRIMARY KEY (`table_id`),
KEY `table_mid` (`table_mid`),
KEY `table_name` (`table_name`(40))
) ENGINE=MyISAM;	
	
#
# Table structure for table `tdmcreate_fields` 16
#
		
CREATE TABLE `tdmcreate_fields` (
`field_id` int (5) unsigned NOT NULL auto_increment,
`field_mid` int (5) unsigned NOT NULL default '0',
`field_tid` int (5) unsigned NOT NULL default '0',
`field_numb` int (10) unsigned NOT NULL default '0',
`field_name` varchar (255) NOT NULL default '',
`field_type` varchar (100) NOT NULL default '',
`field_value` char (4) NOT NULL default '',
`field_attribute` varchar (50) NOT NULL default '',
`field_null` char (10) NOT NULL default '',
`field_default` varchar (150) NOT NULL default '',
`field_key` char (10) NOT NULL default '',
`field_auto_increment` tinyint (1) unsigned NOT NULL default '0',
`field_admin` tinyint (1) unsigned NOT NULL default '0',
`field_user` tinyint (1) unsigned NOT NULL default '0',
`field_blocks` tinyint (1) unsigned NOT NULL default '0',
`field_mainfield` tinyint (1) unsigned NOT NULL default '0',
`field_search` tinyint (1) unsigned NOT NULL default '0',
`field_required` tinyint (1) unsigned NOT NULL default '0',
PRIMARY KEY (`field_id`),
KEY `field_tid` (`field_tid`)
) ENGINE=MyISAM;

#
# Table structure for table `tdmcreate_import` 7
#
		
CREATE TABLE `tdmcreate_import` (
`import_id` int (8) unsigned NOT NULL auto_increment,
`import_name` varchar (255) NOT NULL default '',
`import_mid` int (5) unsigned NOT NULL default '0',
`import_nbtables` int (5) unsigned NOT NULL default '0',
`import_tablename` varchar (50) NOT NULL default '',
`import_nbfields` int (5) unsigned NOT NULL default '0',
`import_fieldelements` varchar (255) NOT NULL default '',
PRIMARY KEY (`import_id`),
KEY `import_mid` (`import_mid`),
KEY `import_name` (`import_name`(40))
) ENGINE=MyISAM;

#
# Table structure for table `tdmcreate_fieldtype` 2
#

CREATE TABLE `tdmcreate_fieldtype` (
`fieldtype_value` varchar(255) NOT NULL default '',
`fieldtype_name` varchar(255) NOT NULL default '',
PRIMARY KEY (`fieldtype_value`)
) ENGINE=MyISAM;

INSERT INTO `tdmcreate_fieldtype` (`fieldtype_value`, `fieldtype_name`) VALUES
('', ''),
('int', 'INT'),
('tinyint', 'TINYINT'),
('mediumint', 'MEDIUMINT'),
('smallint', 'SMALLINT'),
('float', 'FLOAT'),
('double', 'DOUBLE'),
('decimal', 'DECIMAL'),
('enum', 'ENUM'),
('email', 'EMAIL'),
('url', 'URL'),
('char', 'CHAR'),
('varchar', 'VARCHAR'),
('text', 'TEXT'),
('tinytest', 'TINYTEXT'),
('mediumtext', 'MEDIUMTEXT'),
('longtext', 'LONGTEXT'),
('date', 'DATE'),
('datetime', 'DATETIME'),
('timestamp', 'TIMESTAMP'),
('time', 'TIME'),
('year', 'YEAR');

#
# Table structure for table `tdmcreate_fieldattributes` 2
#

CREATE TABLE `tdmcreate_fieldattributes` (
`fieldattributes_value` varchar(255) NOT NULL default '',
`fieldattributes_name` varchar(255) NOT NULL default '',
PRIMARY KEY (`fieldattributes_value`)
) ENGINE=MyISAM;

INSERT INTO `tdmcreate_fieldattributes` (`fieldattributes_value`, `fieldattributes_name`) VALUES
('', ''),
('binary', 'BINARY'),
('unsigned', 'UNSIGNED'),
('unsigned zerofill', 'UNSIGNED ZEROFILL'),
('ON UPDATE CURRENT_TIMESTAMP', 'on update CURRENT_TIMESTAMP');

#
# Table structure for table `tdmcreate_fieldnull` 2
#

CREATE TABLE `tdmcreate_fieldnull` (
`fieldnull_value` varchar(255) NOT NULL default '',
`fieldnull_name` varchar(255) NOT NULL default '',
PRIMARY KEY (`fieldnull_value`)
) ENGINE=MyISAM;

INSERT INTO `tdmcreate_fieldnull` (`fieldnull_value`, `fieldnull_name`) VALUES
('not null', 'NOT NULL'),
('null', 'NULL');

#
# Table structure for table `tdmcreate_fieldkey` 2
#

CREATE TABLE `tdmcreate_fieldkey` (
`fieldkey_value` varchar(255) NOT NULL default '',
`fieldkey_name` varchar(255) NOT NULL default '',
PRIMARY KEY (`fieldkey_value`)
) ENGINE=MyISAM;

INSERT INTO `tdmcreate_fieldkey` (`fieldkey_value`, `fieldkey_name`) VALUES
('', ''),
('primary', 'PRIMARY'),
('unique', 'UNIQUE'),
('index', 'INDEX'),
('fulltext', 'FULLTEXT');

#
# Table structure for table `tdmcreate_fieldelements` 9
#

CREATE TABLE `tdmcreate_fieldelements` (
`fieldelements_id` int(5) NOT NULL auto_increment,
`fieldelements_value` varchar(255) NOT NULL default '',
`fieldelements_name` varchar(255) NOT NULL default '',
`fieldelements_admin` tinyint(1) NOT NULL default '0',
`fieldelements_user` tinyint(1) NOT NULL default '0',
`fieldelements_block` tinyint(1) NOT NULL default '0',
`fieldelements_mfield` tinyint(1) NOT NULL default '0',
`fieldelements_search` tinyint(1) NOT NULL default '0',
`fieldelements_required` tinyint(1) NOT NULL default '0',
PRIMARY KEY (`fieldelements_id`),
KEY `fieldelements_value` (`fieldelements_value`),
KEY `fieldelements_name` (`fieldelements_name`)
) ENGINE=MyISAM;

INSERT INTO `tdmcreate_fieldelements` (fieldelements_id, `fieldelements_value`, `fieldelements_name`, `fieldelements_admin`, `fieldelements_user`, `fieldelements_block`, `fieldelements_mfield`, `fieldelements_search`, `fieldelements_required`) VALUES
(1, '', 'None', 0, 0, 0, 0, 0, 0),
(2, 'XoopsFormText', 'Text', 0, 0, 0, 0, 0, 0),
(3, 'XoopsFormTextArea', 'TextArea', 0, 0, 0, 0, 0, 0),
(4, 'XoopsFormDhtmlTextArea', 'DhtmlTextArea', 0, 0, 0, 0, 0, 0),
(5, 'XoopsFormCheckBox', 'CheckBox', 0, 0, 0, 0, 0, 0),
(6, 'XoopsFormRadioYN', 'RadioYN', 0, 0, 0, 0, 0, 0),
(7, 'XoopsFormSelect', 'SelectBox', 0, 0, 0, 0, 0, 0),
(8, 'XoopsFormSelectUser', 'SelectUser', 0, 0, 0, 0, 0, 0),
(9, 'XoopsFormColorPicker', 'ColorPicker', 0, 0, 0, 0, 0, 0),
(10, 'XoopsFormUploadImage', 'UploadImage', 0, 0, 0, 0, 0, 0),
(11, 'XoopsFormUploadFile', 'UploadFile', 0, 0, 0, 0, 0, 0),
(12, 'XoopsFormTextDateSelect', 'TextDateSelect', 0, 0, 0, 0, 0, 0);
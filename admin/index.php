<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * tdmcreate module
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         tdmcreate
 * @since           2.6.0
 * @author          TDM Xoops (AKA Developers)
 * @version         $Id: index.php 10665 2012-12-27 10:14:15Z timgno $
 */
include dirname(__FILE__) . '/header.php';
// Heaser
$xoops->header();
// tdmcreate modules
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('mod_id', 0, '!='));
$tdmcreate_modules = $modules_Handler->getCount($criteria);
// tdmcreate tables
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('table_mid', 0, '!='));
$tdmcreate_tables = $tables_Handler->getCount($criteria);
// tdmcreate import
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('import_id', 0, '!='));
$tdmcreate_import = $import_Handler->getCount($criteria);

$r = "red"; $g = "green";
$modules_color = $tdmcreate_modules == 0 ? $r : $g;
$tables_color = $tdmcreate_tables == 0 ? $r : $g;
$import_color = $tdmcreate_import == 0 ? $r : $g;

$admin_menu->displayNavigation('index.php');

$admin_menu->addInfoBox(TDMCreateLocale::INDEX_STATISTICS);
$admin_menu->addInfoBoxLine(sprintf(TDMCreateLocale::F_INDEX_NMTOTAL, '<span class="'.$modules_color.'">' . $tdmcreate_modules . '</span>'));
$admin_menu->addInfoBoxLine(sprintf(TDMCreateLocale::F_INDEX_NTTOTAL, '<span class="'.$tables_color.'">' . $tdmcreate_tables . '</span>'));
$admin_menu->addInfoBoxLine(sprintf(TDMCreateLocale::F_INDEX_NITOTAL, '<span class="'.$import_color.'">' . $tdmcreate_import . '</span>'));

// folder path
$folder_path = array(
   XOOPS_UPLOAD_PATH . '/tdmcreate/', 
   XOOPS_UPLOAD_PATH . '/tdmcreate/files',
   XOOPS_UPLOAD_PATH . '/tdmcreate/repository',   
   XOOPS_UPLOAD_PATH . '/tdmcreate/images',
   XOOPS_UPLOAD_PATH . '/tdmcreate/images/modules',
   XOOPS_UPLOAD_PATH . '/tdmcreate/images/tables'
);
foreach ($folder_path as $folder) {
	$admin_menu->addConfigBoxLine($folder, 'folder');
	$admin_menu->addConfigBoxLine(array($folder, '777'), 'chmod');
}
// extension
$extensions = array('xtranslator' => 'extension');

foreach ($extensions as $module => $type) {
    $admin_menu->addConfigBoxLine(array($module, 'warning'), $type);
}

$admin_menu->displayIndex();
$xoops->footer();
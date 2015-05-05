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
include __DIR__ . '/header.php';
// header
$xoops->header();
// tdmcreate modules
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('mod_id', 0, '!='));
$tdmcreateModules = $modulesHandler->getCount($criteria);
// tdmcreate tables
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('table_mid', 0, '!='));
$tdmcreateTables = $tablesHandler->getCount($criteria);
// tdmcreate import
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('import_id', 0, '!='));
$tdmcreateImport = $importHandler->getCount($criteria);

$r = "red"; $g = "green";
$modulesColor = $tdmcreateModules == 0 ? $r : $g;
$tablesColor = $tdmcreateTables == 0 ? $r : $g;
$importColor = $tdmcreateImport == 0 ? $r : $g;

$adminMenu->displayNavigation('index.php');

$adminMenu->addInfoBox(TDMCreateLocale::INDEX_STATISTICS);
$adminMenu->addInfoBoxLine(sprintf(TDMCreateLocale::F_INDEX_NMTOTAL, '<span class="'.$modulesColor.'">' . $tdmcreateModules . '</span>'));
$adminMenu->addInfoBoxLine(sprintf(TDMCreateLocale::F_INDEX_NTTOTAL, '<span class="'.$tablesColor.'">' . $tdmcreateTables . '</span>'));
$adminMenu->addInfoBoxLine(sprintf(TDMCreateLocale::F_INDEX_NITOTAL, '<span class="'.$importColor.'">' . $tdmcreateImport . '</span>'));

// folder path
$folderPath = array(
   XOOPS_UPLOAD_PATH . '/tdmcreate/', 
   XOOPS_UPLOAD_PATH . '/tdmcreate/files',
   XOOPS_UPLOAD_PATH . '/tdmcreate/repository',   
   XOOPS_UPLOAD_PATH . '/tdmcreate/images',
   XOOPS_UPLOAD_PATH . '/tdmcreate/images/modules',
   XOOPS_UPLOAD_PATH . '/tdmcreate/images/tables'
);
foreach ($folderPath as $folder) {
	$adminMenu->addConfigBoxLine($folder, 'folder');
	$adminMenu->addConfigBoxLine(array($folder, '777'), 'chmod');
}
// extension
$extensions = array('xtranslator' => 'extension');

foreach ($extensions as $module => $type) {
    $adminMenu->addConfigBoxLine(array($module, 'warning'), $type);
}

$adminMenu->displayIndex();

include __DIR__ . '/footer.php';

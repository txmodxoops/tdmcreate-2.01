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
 * @author          TXMod Xoops (AKA Timgno)
 * @version         $Id: header.php 10665 2012-12-27 10:14:15Z timgno $
 */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/include/cp_header.php';
include_once dirname(dirname(__FILE__)) . '/include/common.php';
include_once dirname(dirname(__FILE__)) . '/include/functions.php';
include_once dirname(dirname(__FILE__)) . '/class/helper.php';
// Get main instance
XoopsLoad::load('system', 'system');
$system = System::getInstance();
// Get main locale instance 
$xoops = Xoops::getInstance();
$helper = TDMCreate::getInstance();
$request = $xoops->request();	
// Get handler
$modules_Handler = $helper->getHandlerModules();
$tables_Handler = $helper->getHandlerTables();
$import_Handler = $helper->getHandlerImport();
$fields_Handler = $helper->getHandlerFields();
// Get $_POST, $_GET, $_REQUEST
$op = $request->asStr('op', 'list');
$start = $request->asInt('start', 0);
// Parameters
$limit = $helper->getConfig('adminpager');
// Get admin menu istance
$admin_menu = new XoopsModuleAdmin();
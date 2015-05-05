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
 * @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license     GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @package	    tdmcreate
 * @since		2.6.0
 * @author 	    XOOPS Development Team
 * @version	    $Id common.php 10900 2013-01-19 13:00:30Z timgno $
**/

define('XOOPS_ICONS32_PATH', XOOPS_ROOT_PATH . '/media/xoops/images/icons/32');

define('TDMC_DIRNAME', basename(dirname(__DIR__)));
define('TDMC_URL', XOOPS_URL . '/modules/' . TDMC_DIRNAME);
define('TDMC_ADMIN_URL', TDMC_URL . '/admin');
define('TDMC_UPLOAD_URL', XOOPS_URL . '/uploads/' . TDMC_DIRNAME);
define('TDMC_UPLOAD_URL_IMG', TDMC_UPLOAD_URL . '/images');
define('TDMC_UPLOAD_URL_FILES', TDMC_UPLOAD_URL . '/files');
define('TDMC_UPLOAD_URL_REPO', TDMC_UPLOAD_URL . '/repository');
define('TDMC_MODULES_URL_IMG', TDMC_UPLOAD_URL_IMG . '/modules');
define('TDMC_EXTENSIONS_URL_IMG', TDMC_UPLOAD_URL_IMG . '/extensions');
define('TDMC_TABLES_URL_IMG', TDMC_UPLOAD_URL_IMG . '/tables');
define('TDMC_ROOT_PATH', XOOPS_ROOT_PATH . '/modules/' . TDMC_DIRNAME);
define('TDMC_UPLOAD_PATH', XOOPS_ROOT_PATH . '/uploads/' . TDMC_DIRNAME);
define('TDMC_UPLOAD_PATH_IMG', TDMC_UPLOAD_PATH . '/images');
define('TDMC_UPLOAD_PATH_FILES', TDMC_UPLOAD_PATH . '/files');
define('TDMC_UPLOAD_PATH_REPO', TDMC_UPLOAD_PATH . '/repository');
define('TDMC_MODULES_PATH_IMG', TDMC_UPLOAD_PATH_IMG . '/modules');
define('TDMC_EXTENSIONS_PATH_IMG', TDMC_UPLOAD_PATH_IMG . '/extensions');
define('TDMC_TABLES_PATH_IMG', TDMC_UPLOAD_PATH_IMG . '/tables');

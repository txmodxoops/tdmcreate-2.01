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
 * @version         $Id: install.php 10665 2012-12-27 10:14:15Z timgno $
 */

function xoops_module_install_tdmcreate($module)
{
    $xoops = Xoops::getInstance();
    $xoops->loadLanguage('modinfo');
    $xoops->registry()->set('tdmcreate_id', $module->getVar('mid'));
	
    $indexFile = XOOPS_UPLOAD_PATH.'/index.html';
	$blankFile = XOOPS_UPLOAD_PATH.'/blank.gif';
	
	//Creation of folder 'uploads/tdmcreate'
	$module_name = XOOPS_UPLOAD_PATH.'/tdmcreate';
	if(!is_dir($module_name)) {
		mkdir($module_name, 0777);
		chmod($module_name, 0777);
	}
	copy($indexFile, $module_name.'/index.html');
	
	//Creation of the 'files' folder in uploads
	$files_uploads = $module_name.'/files';
	if(!is_dir($files_uploads)) {
		mkdir($files_uploads, 0777);
		chmod($files_uploads, 0777);
	}
	copy($indexFile, $files_uploads.'/index.html');
	
	//Creation of the 'repository' folder in uploads
	$repository_uploads = $module_name.'/repository';
	if(!is_dir($repository_uploads)) {
		mkdir($repository_uploads, 0777);
		chmod($repository_uploads, 0777);
	}
	copy($indexFile, $repository_uploads.'/index.html');
	
	//Creation of the 'repository/modules' folder in uploads
	$repository_modules = $repository_uploads.'/modules';
	if(!is_dir($repository_modules)) {
		mkdir($repository_modules, 0777);
		chmod($repository_modules, 0777);
	}
	copy($indexFile, $repository_modules.'/index.html');
	
	//Creation of the 'images' folder in uploads
	$images_uploads = $module_name.'/images';
	if(!is_dir($images_uploads)) {
		mkdir($images_uploads, 0777);
		chmod($images_uploads, 0777);
	}
	copy($indexFile, $images_uploads.'/index.html');
	copy($blankFile, $images_uploads.'/blank.gif');	
	
	//Creation of the 'images/modules' folder in uploads
	$module_uploads = $images_uploads.'/modules';
	$default_slogo = XOOPS_ROOT_PATH.'/modules/tdmcreate/images/default_slogo.png';
	$naked_slogo = XOOPS_ROOT_PATH.'/modules/tdmcreate/images/naked.png';
	if(!is_dir($module_uploads)) {
		mkdir($module_uploads, 0777);
		chmod($module_uploads, 0777);
	}
	copy($indexFile, $module_uploads.'/index.html');
	copy($blankFile, $module_uploads.'/blank.gif');
	copy($naked_slogo, $module_uploads.'/naked.png');
	copy($default_slogo, $module_uploads.'/default_slogo.png');
	
	//Creation of the folder 'images/tables' in uploads
	$tables_uploads = $images_uploads.'/tables';
	if(!is_dir($tables_uploads)) {
		mkdir($tables_uploads, 0777);
		chmod($tables_uploads, 0777);
	}
	copy($indexFile, $tables_uploads.'/index.html');	
	copy($blankFile, $tables_uploads.'/blank.gif');
	
	//Creation of the folder 'images/extensions' in uploads
	$extensions_uploads = $images_uploads.'/extensions';
	if(!is_dir($extensions_uploads)) {
		mkdir($extensions_uploads, 0777);
		chmod($extensions_uploads, 0777);
	}
	copy($indexFile, $extensions_uploads.'/index.html');
	copy($blankFile, $extensions_uploads.'/blank.gif');
	
    return true;
}
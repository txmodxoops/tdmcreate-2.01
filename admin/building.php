<?php

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/
use Xoops\Core\Request;

/**
 * tdmcreate module.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 *
 * @since           2.6.0
 *
 * @author          TDM Xoops (AKA Developers)
 *
 * @version         $Id: building.php 10665 2012-12-27 10:14:15Z timgno $
 */
include __DIR__.'/header.php';
// Get $_POST, $_GET, $_REQUEST
$op = Request::getCmd('op', 'default');
$mid = Request::getInt('mod_id');
$moduleObj = $modulesHandler->get($mid);
// Header Template
$xoops->header('admin:tdmcreate/tdmcreate_building.tpl');
// Navigation
$adminMenu->renderNavigation('building.php');
//
switch ($op) {
    case 'default':
    default:
        $adminMenu->addTips(TDMCreateLocale::BUILDING_TIPS);
        $adminMenu->renderTips();
        $numbModules = $modulesHandler->getCountModules();
        if (0 == $numbModules) {
            $xoops->redirect('modules.php?op=new', 2, TDMCreateLocale::E_NO_MODULES);
        }
        $form = new Xoops\Form\SimpleForm(TDMCreateLocale::BUILDING_TITLE, 'building', 'building.php', 'post', true);
        unset($numbModules);

        $modulesSelect = new Xoops\Form\Select(TDMCreateLocale::BUILDING_MODULES, 'mod_id', 'mod_id');
        $modulesSelect->addOption(0, TDMCreateLocale::BUILDING_SELECT_DEFAULT);
        $modulesSelect->addOptionArray($modulesHandler->getList());
        $form->addElement($modulesSelect);

        $form->addElement(new Xoops\Form\Hidden('op', 'build'));
        $form->addElement(new Xoops\Form\Button('', 'submit', XoopsLocale::A_SUBMIT, 'submit'));
        $xoops->tpl()->assign('form', $form->render());
    break;

    case 'build':
        // Get var module dirname
        $moduleDirname = $moduleObj->getVar('mod_dirname');
        // Directories for copy from to
        if (!$moduleObj->getVar('mod_isextension')) {
            $fromDir = TDMC_UPLOAD_REPOSITORY_MODULES_PATH.'/'.strtolower($moduleDirname);
        } else {
            $fromDir = TDMC_UPLOAD_REPOSITORY_EXTENSIONS_PATH.'/'.strtolower($moduleDirname);
        }
        $toDir = XOOPS_ROOT_PATH.'/modules/'.strtolower($moduleDirname);
        if (isset($moduleDirname)) {
            $xoopsFile = XoopsFile::getHandler();
            $folder = $xoopsFile->getHandler('folder');
            $folder->delete($fromDir);
            $folder->delete($toDir);
        }
        // Structure
        include_once TDMC_CLASSES_PATH.'/files/architecture.php';
        $handler = TDMCreateArchitecture::getInstance();
        // Creation of the structure of folders and files
        $baseArchitecture = $handler->createBaseFoldersFiles($moduleObj);
        if (false !== $baseArchitecture) {
            $xoops->tpl()->assign('base_architecture', true);
        } else {
            $xoops->tpl()->assign('base_architecture', false);
        }
        // Get files
        $build = array();
        $files = $handler->createFilesToBuilding($moduleObj);
        foreach ($files as $file) {
            if ($file) {
                $build['list'] = $file;
            }
            $xoops->tpl()->append('builds', $build);
        }
        unset($build);
        // Directory to saved all files
        if (!$moduleObj->getVar('mod_isextension')) {
            $extension = 'extension';
            $extensions = 'extensions';
            $xoops->tpl()->assign('building_directory', sprintf(TDMCreateLocale::BUILDING_DIRECTORY, $modules, $module, $moduleDirname));
        } else {
            $module = 'module';
            $modules = 'modules';
            $xoops->tpl()->assign('building_directory', sprintf(TDMCreateLocale::BUILDING_DIRECTORY, $extensions, $extension, $moduleDirname));
        }
        // Copy this module in root modules
        if (1 == $moduleObj->getVar('mod_inroot_copy')) {
            $xoopsFile = XoopsFile::getHandler();
            $folder = $xoopsFile->getHandler('folder', $fromDir);
            $folder->copy($toDir);
        }
    break;
}

include __DIR__.'/footer.php';

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
 * @version         $Id: building.php 10665 2012-12-27 10:14:15Z timgno $
 */
include dirname(__FILE__) . '/header.php';
// Get Action type
$op = $system->cleanVars($_REQUEST, 'op', 'default', 'string');
// heaser
$xoops->header('tdmcreate_building.html');
// Get handler
/* @var $modules_handler TDMCreateModulesHandler */
$modules_Handler = $xoops->getModuleHandler('modules');
/* @var $tables_handler TDMCreateExtensionsHandler */
$tables_Handler = $xoops->getModuleHandler('tables');

$admin_menu->renderNavigation('building.php');
switch ($op) 
{
	case 'default':
	default:
		$form = new XoopsSimpleForm(TDMCreateLocale::BUILDING_TITLE, 'building', 'building.php', 'post', true);

		$mods_select = new XoopsFormSelect(TDMCreateLocale::BUILDING_MODULES, 'mod_name', 'mod_name');
		$mods_select->addOption(0, TDMCreateLocale::BUILDING_SELDEFMOD);
		$mods_select->addOptionArray($modules_Handler->getList());
		$form->addElement($mods_select);	
		
		$form->addElement(new XoopsFormHidden('op', 'build'));
		$form->addElement(new XoopsFormButton('', 'submit', XoopsLocale::A_SUBMIT, 'submit'));	
		$xoops->tpl()->assign('form', $form->render());			
	break;
	
	case 'build':
	    $admin_menu->addItemButton(TDMCreateLocale::BUILDING_FORM, 'building.php', 'application-view-detail');
        $admin_menu->renderButton();
		
		$mods =& $modules_Handler->get($_REQUEST['mod_name']);
		$mods_name = $mods->getVar('mod_name');	    
    break;
}
$xoops->footer();
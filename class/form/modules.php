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
 * @version         $Id: modules.php 11387 2013-04-16 15:19:57Z txmodxoops $
 */
defined('XOOPS_ROOT_PATH') or die("XOOPS root path not defined");

class TDMCreateModulesForm extends XoopsThemeForm
{	
	/**
     * @param TDMCreateModules|XoopsObject $obj
     */
	public function __construct(TDMCreateModules &$obj)
	{
		$xoops = Xoops::getInstance();			 
	
		$title = $obj->isNew() ? sprintf(TDMCreateLocale::ADD_MODULE) : sprintf(TDMCreateLocale::EDIT_MODULE);

		parent::__construct($title, 'form', 'modules.php', 'post', true, 'raw');
        //$this->setExtra('enctype="multipart/form-data"');
		$tabtray = new XoopsFormTabTray('', 'uniqueid');
		// First Break
		//$this->insertBreak('<div class="center"><b>'.TDMCreateLocale::IMPORTANT.'</b></div>', 'head');
		$tab1 = new XoopsFormTab(TDMCreateLocale::IMPORTANT, 'important');
		// Name of Module 
		$mod_tray = new XoopsFormElementTray(TDMCreateLocale::C_MODULE_OR_EXTENSION, "\t");
		$mod_tray->setDescription(TDMCreateLocale::C_MODULE_OR_EXTENSION_DESC);
		$mod_tray->addElement( new XoopsFormText(XoopsLocale::NAME, 'mod_name', 50, 255, $obj->getVar('mod_name')), true);
		$is_extension = $obj->isNew() ? 0 : $obj->getVar('mod_isextension');
		$check_is_extension = new XoopsFormCheckBox(' ', 'isextension', $is_extension);
		$check_is_extension->addOption(1, TDMCreateLocale::QC_ISEXTENSION);
		$mod_tray->addElement($check_is_extension);
		$tab1->addElement($mod_tray);
		// Version module
		$tab1->addElement(new XoopsFormText(XoopsLocale::VERSION, 'mod_version', 2, 4, $obj->getVar('mod_version')), true);
		// Editor
		$editor_configs=array();
		$editor_configs['name'] = 'mod_description';
		$editor_configs['value'] = $obj->getVar('mod_description', 'e');
		$editor_configs['rows'] = 4;
		$editor_configs['cols'] = 80;
		$editor_configs['width'] = '100%';
		$editor_configs['height'] = '400px';
		$editor_configs['editor'] = $xoops->getModuleConfig('editor');				
		$tab1->addElement( new XoopsFormEditor(XoopsLocale::DESCRIPTION, 'mod_description', $editor_configs), true );
		// Author module
		$tab1->addElement(new XoopsFormText(XoopsLocale::AUTHOR, 'mod_author', 50, 255, $obj->getVar('mod_author')), true);
		$tab1->addElement(new XoopsFormText(TDMCreateLocale::C_LICENSE, 'mod_license', 50, 255, $obj->getVar('mod_license')), true);
		$option_tray = new XoopsFormElementTray(XoopsLocale::OPTIONS, '&nbsp;');
			$display_admin = $obj->isNew() ? 0 : $obj->getVar('mod_admin');
			$check_display_admin = new XoopsFormCheckBox(' ', 'mod_admin', $display_admin);
			$check_display_admin->addOption(1, TDMCreateLocale::C_ADMIN);
			$option_tray->addElement($check_display_admin);
			$display_user = $obj->isNew() ? 0 : $obj->getVar('mod_user');
			$check_display_user = new XoopsFormCheckBox(' ', 'mod_user', $display_user);
			$check_display_user->addOption(1, TDMCreateLocale::C_USER);
			$option_tray->addElement($check_display_user);
			$display_submenu = $obj->isNew() ? 0 : $obj->getVar('mod_submenu');
			$check_display_submenu = new XoopsFormCheckBox(' ', 'mod_submenu', $display_submenu);
			$check_display_submenu->addOption(1, TDMCreateLocale::C_SUBMENU);
			$option_tray->addElement($check_display_submenu);
			$active_search = $obj->isNew() ? 0 : $obj->getVar('mod_search');
			$check_active_search = new XoopsFormCheckBox(' ', 'mod_search', $active_search);
			$check_active_search->addOption(1, TDMCreateLocale::C_SEARCH);
			$option_tray->addElement($check_active_search);
			$active_comments = $obj->isNew() ? 0 : $obj->getVar('mod_comments');
			$check_active_comments = new XoopsFormCheckBox(' ', 'mod_comments', $active_comments);
			$check_active_comments->addOption(1, TDMCreateLocale::C_COMMENTS);
			$option_tray->addElement($check_active_comments);
			$active_notifies = $obj->isNew() ? 0 : $obj->getVar('mod_notifications');
			$check_active_notifies = new XoopsFormCheckBox(' ', 'mod_notifications', $active_notifies);
			$check_active_notifies->addOption(1, TDMCreateLocale::C_NOTIFICATIONS);
			$option_tray->addElement($check_active_notifies);
		$tab1->addElement($option_tray);			    
		
		$module_image = $obj->getVar('mod_image') ? $obj->getVar('mod_image') : 'default_slogo.png';	
		$uploadir = 'uploads/tdmcreate/images/modules';
		$imgtray = new XoopsFormElementTray(TDMCreateLocale::C_IMAGE,'<br />');
		$imgpath = sprintf(TDMCreateLocale::CF_IMAGE_PATH, './'.$uploadir.'/');
		$imageselect = new XoopsFormSelect($imgpath, 'modules_image', $module_image);
		$image_array = XoopsLists::getImgListAsArray( XOOPS_ROOT_PATH.'/'.$uploadir );
		foreach( $image_array as $image ) {
			$imageselect->addOption("$image", $image);
		}
		$imageselect->setExtra( "onchange='showImgSelected(\"image3\", \"modules_image\", \"".$uploadir."\", \"\", \"".XOOPS_URL."\")'" );
		$imgtray->addElement($imageselect);
		$imgtray->addElement( new XoopsFormLabel( '', "<br /><img src='".XOOPS_URL."/".$uploadir."/".$module_image."' name='image3' id='image3' alt='' />" ) );		
		$fileseltray = new XoopsFormElementTray('','<br />');
		$fileseltray->addElement(new XoopsFormFile(XoopsLocale::A_UPLOAD , 'modules_image', $xoops->getModuleConfig('maxuploadsize')), true);
		$fileseltray->addElement(new XoopsFormLabel(''));
		$imgtray->addElement($fileseltray);
		$tab1->addElement($imgtray);
		
		$tabtray->addElement($tab1);

        /**
         * Not important
         */
        $tab2 = new XoopsFormTab(TDMCreateLocale::NOT_IMPORTANT, 'not_important');
        // Second Break
		//$this->insertBreak('<div class="center"><b>'.TDMCreateLocale::NOT_IMPORTANT.'</b></div>','head');
		$tab2->addElement(new XoopsFormText(TDMCreateLocale::C_AUTHOR_MAIL, 'mod_author_mail', 50, 255, $obj->getVar('mod_author_mail')));
		$tab2->addElement(new XoopsFormText(TDMCreateLocale::C_AUTHOR_WEBSITE_URL, 'mod_author_website_url', 50, 255, $obj->getVar('mod_author_website_url')));
		$tab2->addElement(new XoopsFormText(TDMCreateLocale::C_AUTHOR_WEBSITE_NAME, 'mod_author_website_name', 50, 255, $obj->getVar('mod_author_website_name')));
		$tab2->addElement(new XoopsFormText(TDMCreateLocale::C_CREDITS, 'mod_credits', 50, 255, $obj->getVar('mod_credits')));	
		$tab2->addElement(new XoopsFormText(TDMCreateLocale::C_RELEASE_INFO, 'mod_release_info', 50, 255, $obj->getVar('mod_release_info')));
		$tab2->addElement(new XoopsFormText(TDMCreateLocale::C_RELEASE_FILE, 'mod_release_file', 50, 255, $obj->getVar('mod_release_file')));
		$tab2->addElement(new XoopsFormText(TDMCreateLocale::C_MANUAL, 'mod_manual', 50, 255, $obj->getVar('mod_manual')));
		$tab2->addElement(new XoopsFormText(TDMCreateLocale::C_MANUAL_FILE, 'mod_manual_file', 50, 255, $obj->getVar('mod_manual_file')));
		$tab2->addElement(new XoopsFormText(TDMCreateLocale::C_DEMO_SITE_URL, 'mod_demo_site_url', 50, 255, $obj->getVar('mod_demo_site_url')));
		$tab2->addElement(new XoopsFormText(TDMCreateLocale::C_DEMO_SITE_NAME, 'mod_demo_site_name', 50, 255, $obj->getVar('mod_demo_site_name')));
		$tab2->addElement(new XoopsFormText(TDMCreateLocale::C_SUPPORT_URL, 'mod_support_url', 50, 255, $obj->getVar('mod_support_url')));
		$tab2->addElement(new XoopsFormText(TDMCreateLocale::C_SUPPORT_NAME, 'mod_support_name', 50, 255, $obj->getVar('mod_support_name')));
		$tab2->addElement(new XoopsFormText(TDMCreateLocale::C_WEBSITE_URL, 'mod_website_url', 50, 255, $obj->getVar('mod_website_url')));
		$tab2->addElement(new XoopsFormText(TDMCreateLocale::C_WEBSITE_NAME, 'mod_website_name', 50, 255, $obj->getVar('mod_website_name')));
		$tab2->addElement(new XoopsFormText(TDMCreateLocale::C_RELEASE, 'mod_release', 50, 255, $obj->getVar('mod_release')));
		$tab2->addElement(new XoopsFormText(TDMCreateLocale::C_STATUS, 'mod_status', 50, 255, $obj->getVar('mod_status')));	
		
        $tab2->addElement(new XoopsFormText(TDMCreateLocale::C_PAYPAL_BUTTON, 'mod_paypal_button', 50, 255, $obj->getVar('mod_paypal_button')));
		$tab2->addElement(new XoopsFormText(TDMCreateLocale::C_SUBVERSION, 'mod_subversion', 50, 255, $obj->getVar('mod_subversion')));	         
        
		/**
         * Button submit
         */
        $button_tray = new XoopsFormElementTray('', '');
        $button_tray->addElement(new XoopsFormHidden('op', 'save'));
			
        $button = new XoopsFormButton('', 'submit', XoopsLocale::A_SUBMIT, 'submit' );
        $button->setClass('btn');
		$button_tray->addElement($button);
		$tab2->addElement($button_tray);
		$tabtray->addElement($tab2);
		
		if (!$obj->isNew()) {
            $this->addElement(new XoopsFormHidden( 'id', $obj->getVar('mod_id') ) );
        }
		
		$this->addElement($tabtray);
	}
}
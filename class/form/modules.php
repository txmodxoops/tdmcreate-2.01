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
 * @author          Team Developement Modules Xoops (AKA TDM)
 * @version         $Id: modules.php 13060 2015-05-12 19:29:44Z timgno $
 */
defined('XOOPS_ROOT_PATH') or die("XOOPS root path not defined");

class TDMCreateModulesForm extends Xoops\Form\ThemeForm
{	
	/**
     * @param TDMCreateModules|XoopsObject $obj
     */
	public function __construct(TDMCreateModules &$obj)
	{
		$helper = TDMCreate::getInstance();
        $xoops = $helper->xoops();
        $xoops->theme()->addStylesheet('modules/tdmcreate/assets/css/styles.css');
		//
		$title = $obj->isNew() ? sprintf(TDMCreateLocale::A_ADD_MODULE) : sprintf(TDMCreateLocale::A_EDIT_MODULE);
		parent::__construct($title, 'form', 'modules.php', 'post', true, 'raw');
		//
		$tabtray = new Xoops\Form\TabTray('', 'uniqueid', $xoops->getModuleConfig('jquery_theme', 'system'));
		//
		$tab1 = new Xoops\Form\Tab(TDMCreateLocale::IMPORTANT, 'important');
		// Name of Module 
		$tab1->setDescription(TDMCreateLocale::C_MODULE_OR_EXTENSION_DESC);
		$tab1->addElement( new Xoops\Form\Text(TDMCreateLocale::C_NAME, 'mod_name', 30, 155, $obj->getVar('mod_name')), true);
		$tab1->addElement( new Xoops\Form\Text(TDMCreateLocale::C_DIRECTORY_NAME, 'mod_dirname', 30, 155, $obj->getVar('mod_dirname')), true);	
		// Version module
		$tab1->addElement(new Xoops\Form\Text(TDMCreateLocale::C_VERSION, 'mod_version', 2, 4, $obj->getVar('mod_version')), true);
        $tab1->addElement(new Xoops\Form\Text(TDMCreateLocale::C_SINCE, 'mod_since', 2, 4, $obj->getVar('mod_since')), true);
        $tab1->addElement(new Xoops\Form\Text(TDMCreateLocale::C_MIN_PHP, 'mod_min_php', 2, 4, $obj->getVar('mod_min_php')), true);
        $tab1->addElement(new Xoops\Form\Text(TDMCreateLocale::C_MIN_XOOPS, 'mod_min_xoops', 2, 4, $obj->getVar('mod_min_xoops')), true);
        $tab1->addElement(new Xoops\Form\Text(TDMCreateLocale::C_MIN_ADMIN, 'mod_min_admin', 2, 4, $obj->getVar('mod_min_admin')), true);
        $tab1->addElement(new Xoops\Form\Text(TDMCreateLocale::C_MIN_MYSQL, 'mod_min_mysql', 2, 4, $obj->getVar('mod_min_mysql')), true);
		// Editor
		$editorConfigs = array();
		$editorConfigs['name']   = 'mod_description';
		$editorConfigs['value']  = $obj->getVar('mod_description', 'e');
		$editorConfigs['rows']   = 4;
		$editorConfigs['cols']   = 80;
		$editorConfigs['editor'] = $xoops->getModuleConfig('editor');				
		$tab1->addElement( new Xoops\Form\Editor(XoopsLocale::C_DESCRIPTION, 'mod_description', $editorConfigs), true );
		// Author module
		$tab1->addElement(new Xoops\Form\Text(XoopsLocale::C_AUTHOR, 'mod_author', 50, 255, $obj->getVar('mod_author')), true);
		$tab1->addElement(new Xoops\Form\Text(TDMCreateLocale::C_LICENSE, 'mod_license', 50, 255, $obj->getVar('mod_license')), true);		
		$tabtray->addElement($tab1);
		//
		$tab2 = new Xoops\Form\Tab(TDMCreateLocale::CREATE_LOGO, 'create_logo');
		$moduleImage = $obj->getVar('mod_image') ? $obj->getVar('mod_image') : 'default.png';	
		$uploadir    = 'uploads/tdmcreate/images/modules';
		$imgtray     = new Xoops\Form\ElementTray(TDMCreateLocale::C_IMAGE,'<br /><br />');
		$imgpath     = sprintf(TDMCreateLocale::CF_IMAGE_PATH, './'.$uploadir.'/');
		$imageselect = new Xoops\Form\Select($imgpath, 'modules_image', $moduleImage);
		$image_array = XoopsLists::getImgListAsArray( XOOPS_ROOT_PATH.'/'.$uploadir );
		foreach( $image_array as $image ) {
			$imageselect->addOption("$image", $image);
		}
		$imageselect->setExtra( "onchange='showImgSelected(\"image3\", \"modules_image\", \"".$uploadir."\", \"\", \"".XOOPS_URL."\")'" );
		$imgtray->addElement($imageselect);
		$imgtray->addElement( new XoopsFormLabel( '', "<br /><img src='".XOOPS_URL."/".$uploadir."/".$moduleImage."' name='image3' id='image3' alt='' />" ) );		
		$fileseltray = new Xoops\Form\ElementTray('','<br />');
		$fileseltray->addElement(new XoopsFormFile(XoopsLocale::A_UPLOAD , 'modules_image', $xoops->getModuleConfig('maxuploadsize')));
		$fileseltray->addElement(new XoopsFormLabel(''));
		$imgtray->addElement($fileseltray);
		$tab2->addElement($imgtray, true);		
		$tabtray->addElement($tab2);
		//
		$tab3 		= new Xoops\Form\Tab(TDMCreateLocale::OPTIONS_CHECK, 'options_check');
		$optionTray = new Xoops\Form\ElementTray(TDMCreateLocale::C_OPTIONS, '<br />');
			$moduleCheckboxAll = new Xoops\Form\CheckBox('', "modulebox", 1);
			$moduleCheckboxAll->addOption('allbox', TDMCreateLocale::C_CHECK_ALL);
			$moduleCheckboxAll->setExtra(" onclick='xoopsCheckGroup(\"form\", \"modulebox\" , \"module_option[]\");' ");
			$moduleCheckboxAll->setClass('xo-checkall');
		$optionTray->addElement($moduleCheckboxAll);
		$moduleOption = $obj->getModulesOptions();
        $checkbox 	  = new Xoops\Form\Checkbox('<hr />', 'module_option', $moduleOption, false);
        $checkbox->setDescription(TDMCreateLocale::MODULE_OPTIONS_DESC);
        foreach ($obj->optionsModules as $option) {
            $checkbox->addOption($option, Xoops_Locale::translate('O_MODULE_' . strtoupper($option), 'tdmcreate'));
        }
		$optionTray->addElement($checkbox);
		$tab3->addElement($optionTray);
		$tabtray->addElement($tab3);
        /**
         * Not important
         */
        $tab4 = new Xoops\Form\Tab(TDMCreateLocale::NOT_IMPORTANT, 'not_important');

		$tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_AUTHOR_MAIL, 'mod_author_mail', 50, 255, $obj->getVar('mod_author_mail')));
		$tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_AUTHOR_WEBSITE_URL, 'mod_author_website_url', 50, 255, $obj->getVar('mod_author_website_url')));
		$tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_AUTHOR_WEBSITE_NAME, 'mod_author_website_name', 50, 255, $obj->getVar('mod_author_website_name')));
		$tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_CREDITS, 'mod_credits', 50, 255, $obj->getVar('mod_credits')));	
		$tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_RELEASE_INFO, 'mod_release_info', 50, 255, $obj->getVar('mod_release_info')));
		$tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_RELEASE_FILE, 'mod_release_file', 50, 255, $obj->getVar('mod_release_file')));
		$tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_MANUAL, 'mod_manual', 50, 255, $obj->getVar('mod_manual')));
		$tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_MANUAL_FILE, 'mod_manual_file', 50, 255, $obj->getVar('mod_manual_file')));
		$tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_DEMO_SITE_URL, 'mod_demo_site_url', 50, 255, $obj->getVar('mod_demo_site_url')));
		$tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_DEMO_SITE_NAME, 'mod_demo_site_name', 50, 255, $obj->getVar('mod_demo_site_name')));
		$tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_SUPPORT_URL, 'mod_support_url', 50, 255, $obj->getVar('mod_support_url')));
		$tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_SUPPORT_NAME, 'mod_support_name', 50, 255, $obj->getVar('mod_support_name')));
		$tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_WEBSITE_URL, 'mod_website_url', 50, 255, $obj->getVar('mod_website_url')));
		$tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_WEBSITE_NAME, 'mod_website_name', 50, 255, $obj->getVar('mod_website_name')));
		$tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_RELEASE, 'mod_release', 50, 255, $obj->getVar('mod_release')));
		$tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_STATUS, 'mod_status', 50, 255, $obj->getVar('mod_status')));	
		
        $tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_DONATIONS, 'mod_donations', 50, 255, $obj->getVar('mod_donations')));
		$tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_SUBVERSION, 'mod_subversion', 50, 255, $obj->getVar('mod_subversion')));        
        
		/**
         * Button submit
         */
        $buttonTray = new Xoops\Form\ElementTray('', '');
        $buttonTray->addElement(new Xoops\Form\Hidden('op', 'save'));
			
        $button = new Xoops\Form\Button('', 'submit', XoopsLocale::A_SUBMIT, 'submit' );
        $button->setClass('btn');
		$buttonTray->addElement($button);
		$tab4->addElement($buttonTray);
		$tabtray->addElement($tab4);
		
		if (!$obj->isNew()) {
            $this->addElement(new Xoops\Form\Hidden( 'mod_id', $obj->getVar('mod_id') ) );
        }
		
		$this->addElement($tabtray);
	}
}
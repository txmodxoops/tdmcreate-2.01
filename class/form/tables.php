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
 * @version         $Id: tables.php 11387 2013-04-16 15:19:57Z txmodxoops $
 */	
defined('XOOPS_ROOT_PATH') or die('XOOPS root path not defined');

class TDMCreateTablesForm extends Xoops\Form\ThemeForm
{ 
	/**
     * @param TDMCreateTables|XoopsObject $obj
     */
	public function __construct(TDMCreateTables &$obj)
	{	    
		$helper = TDMCreate::getInstance();
        $xoops = $helper->xoops();
        $xoops->theme()->addStylesheet('modules/tdmcreate/assets/css/styles.css');
		//
		$title = $obj->isNew() ? sprintf(TDMCreateLocale::A_ADD_TABLE) : sprintf(TDMCreateLocale::A_EDIT_TABLE);		
		parent::__construct($title, 'form', 'tables.php', 'post', true, 'raw');
		//
		if (!$obj->isNew()) {		
		    $this->addElement(new Xoops\Form\Hidden('id', $obj->getVar('table_id')));
		}
		//
		$tabtray = new Xoops\Form\TabTray('', 'uniqueid', $xoops->getModuleConfig('jquery_theme', 'system'));
		//
		$tab1 = new Xoops\Form\Tab(TDMCreateLocale::IMPORTANT, 'important');
		//
        $modulesHandler = $xoops->getModuleHandler('modules');
    	$modulesSelect  = new Xoops\Form\Select(TDMCreateLocale::MODULES_LIST, 'table_mid', $obj->getVar('table_mid'));
		$modulesSelect->addOption(0, TDMCreateLocale::MODULE_SELECT_DEFAULT);
    	$modulesSelect->addOptionArray($modulesHandler->getList());
    	$tab1->addElement($modulesSelect, true);		
		//
		$tableName = new Xoops\Form\Text(TDMCreateLocale::TABLE_NAME, 'table_name', 50, 255, $obj->getVar('table_name'));
		$tableName->setDescription(TDMCreateLocale::TABLE_NAME_DESC);
		$tab1->addElement($tableName, true);
		$tableFieldname = new Xoops\Form\Text(TDMCreateLocale::TABLE_FIELD_NAME, 'table_fieldname', 3, 50, $obj->getVar('table_fieldname'));
		$tableFieldname->setDescription(TDMCreateLocale::TABLE_FIELD_NAME_DESC);
		$tab1->addElement($tableFieldname);
		$tableNmbField = new Xoops\Form\Text(TDMCreateLocale::TABLE_FIELDS_NUMBER, 'table_nbfields', 2, 50, $obj->getVar('table_nbfields'));
		$tableNmbField->setDescription(TDMCreateLocale::TABLE_FIELDS_NUMBER_DESC);
		$tab1->addElement($tableNmbField, true);		
		// table_image	
		$tableImage  = $obj->getVar('table_image') ? $obj->getVar('table_image') : 'blank.gif';	
		$uploadir    = 'media/xoops/images/icons/32';
		$imgtray     = new Xoops\Form\ElementTray(TDMCreateLocale::C_IMAGE,'<br />');
		$imgpath     = sprintf(TDMCreateLocale::CF_IMAGE_PATH, './'.$uploadir.'/');
		$imageSelect = new Xoops\Form\Select($imgpath, 'tables_image', $tableImage, 5);
		$imageArray  = XoopsLists::getImgListAsArray( XOOPS_ROOT_PATH.'/'.$uploadir );
		foreach( $imageArray as $image ) {
			$imageSelect->addOption("{$image}", $image);
		}
		$imageSelect->setExtra( "onchange='showImgSelected(\"image3\", \"tables_image\", \"".$uploadir."\", \"\", \"".XOOPS_URL."\")'" );
		$imgtray->addElement($imageSelect);
		$imgtray->addElement( new Xoops\Form\Label( '', "<br /><img src='".XOOPS_URL."/".$uploadir."/".$tableImage."' name='image3' id='image3' alt='' />" ) );		
		$fileseltray = new Xoops\Form\ElementTray('','<br />');
		$fileseltray->addElement(new Xoops\Form\File(XoopsLocale::A_UPLOAD, 'attachedfile', $xoops->getModuleConfig('maxuploadsize')));
		$fileseltray->addElement(new Xoops\Form\Label(''));
		$imgtray->addElement($fileseltray);
		$tab1->addElement($imgtray);
		$tabtray->addElement($tab1);
		/**
         * Not important
         */
        $tab2 = new Xoops\Form\Tab(TDMCreateLocale::L_OPTIONS_CHECK, 'options_check');
		
		$optionTray = new Xoops\Form\ElementTray(XoopsLocale::OPTIONS, '<br />');
			$tableCheckboxAll = new Xoops\Form\CheckBox('', "tablebox", 1);
			$tableCheckboxAll->addOption('allbox', TDMCreateLocale::C_CHECK_ALL);
			$tableCheckboxAll->setExtra(" onclick='xoopsCheckAll(\"form\", \"tablebox\");' ");
			$tableCheckboxAll->setClass('xo-checkall');
		$optionTray->addElement($tableCheckboxAll);
			$tableBlocks        = $obj->isNew() ? 0 : $obj->getVar('table_blocks');
			$displayBlocksCheck = new Xoops\Form\CheckBox(' ', "table_blocks", $tableBlocks);
			$displayBlocksCheck->addOption(1, TDMCreateLocale::TABLE_BLOCKS);
		$optionTray->addElement($displayBlocksCheck);
			$tableAdmin        = $obj->isNew() ? 0 : $obj->getVar('table_admin');
			$displayAdminCheck = new Xoops\Form\CheckBox(' ', "table_admin", $tableAdmin);
			$displayAdminCheck->addOption(1, TDMCreateLocale::TABLE_ADMIN);
		$optionTray->addElement($displayAdminCheck);
			$tableUser        = $obj->isNew() ? 0 : $obj->getVar('table_user');
			$displayUserCheck = new Xoops\Form\CheckBox(' ', "table_user", $tableUser);
			$displayUserCheck->addOption(1, TDMCreateLocale::TABLE_USER);
		$optionTray->addElement($displayUserCheck);
			$tableSubmenu        = $obj->isNew() ? 0 : $obj->getVar('table_submenu');
			$displaySubmenuCheck = new Xoops\Form\CheckBox(' ', "table_submenu", $tableSubmenu);
			$displaySubmenuCheck->addOption(1, TDMCreateLocale::TABLE_SUBMENU);
		$optionTray->addElement($displaySubmenuCheck);
			$tableSearch       = $obj->isNew() ? 0 : $obj->getVar('table_search');
			$activeSearchCheck = new Xoops\Form\CheckBox(' ', "table_search", $tableSearch);
			$activeSearchCheck->addOption(1, TDMCreateLocale::TABLE_SEARCH);
		$optionTray->addElement($activeSearchCheck);
			$tableComments       = $obj->isNew() ? 0 : $obj->getVar('table_comments');
			$activeCommentsCheck = new Xoops\Form\CheckBox(' ', "table_comments", $tableComments);
			$activeCommentsCheck->addOption(1, TDMCreateLocale::TABLE_COMMENTS);
		$optionTray->addElement($activeCommentsCheck);
			$tableNotifications 	  = $obj->isNew() ? 0 : $obj->getVar('table_notifications');
			$activeNotificationsCheck = new Xoops\Form\CheckBox(' ', "table_notifications", $tableNotifications);
			$activeNotificationsCheck->addOption(1, TDMCreateLocale::TABLE_NOTIFICATIONS);
		$optionTray->addElement($activeNotificationsCheck);
		$tab2->addElement($optionTray);			
		
		/**
         * Button submit
         */
        $buttonTray = new Xoops\Form\ElementTray('', '');
        $buttonTray->addElement(new Xoops\Form\Hidden('op', 'save'));
			
        $button = new Xoops\Form\Button('', 'submit', XoopsLocale::A_SUBMIT, 'submit' );
        $button->setClass('btn');
		$buttonTray->addElement($button);
		$tab2->addElement($buttonTray);
		$tabtray->addElement($tab2);
		
		if (!$obj->isNew()) {
            $this->addElement(new Xoops\Form\Hidden( 'id', $obj->getVar('mod_id') ) );
        }
		
		$this->addElement($tabtray);
	}
}
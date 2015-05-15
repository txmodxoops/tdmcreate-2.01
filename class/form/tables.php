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
 * @version         $Id: tables.php 13061 2015-05-15 12:00:25Z txmodxoops $
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
        $tableSoleName = new Xoops\Form\Text(TDMCreateLocale::TABLE_SOLE_NAME, 'table_solename', 10, 100, $obj->getVar('table_solename'));
        $tableSoleName->setDescription(TDMCreateLocale::TABLE_SOLE_NAME_DESC);
        $tab1->addElement($tableSoleName, true);
		$tableFieldname = new Xoops\Form\Text(TDMCreateLocale::TABLE_FIELD_NAME, 'table_fieldname', 3, 50, $obj->getVar('table_fieldname'));
		$tableFieldname->setDescription(TDMCreateLocale::TABLE_FIELD_NAME_DESC);
		$tab1->addElement($tableFieldname);
		$tableNmbField = new Xoops\Form\Text(TDMCreateLocale::TABLE_FIELDS_NUMBER, 'table_nbfields', 2, 50, $obj->getVar('table_nbfields'));
		$tableNmbField->setDescription(TDMCreateLocale::TABLE_FIELDS_NUMBER_DESC);
		$tab1->addElement($tableNmbField, true);
		$tableOrder = $obj->isNew() ? 0 : $obj->getVar('table_order');
		$tableOrder = new Xoops\Form\Text(TDMCreateLocale::TABLE_ORDER, 'table_order', 2, 50, $tableOrder);
		$tableOrder->setDescription(TDMCreateLocale::TABLE_ORDER_DESC);
		$tab1->addElement($tableOrder, true);
		// Table Image
		$tableImage  = $obj->getVar('table_image');
		$tableImage  = $tableImage ? $tableImage : 'blank.gif';
		$uploadDir   = 'media/xoops/images/icons/32';
		$imageTray   = new Xoops\Form\ElementTray(TDMCreateLocale::C_IMAGE,'<br />');
		$imagePath   = sprintf(TDMCreateLocale::CF_IMAGE_PATH, './'.$uploadDir.'/');
		$imageSelect = new Xoops\Form\Select($imagePath, 'tables_image', $tableImage, 5);
		$imageArray  = XoopsLists::getImgListAsArray( XOOPS_ROOT_PATH.'/'.$uploadDir );
		foreach( $imageArray as $image ) {
			$imageSelect->addOption("{$image}", $image);
		}
		$imageSelect->setExtra( "onchange='showImgSelected(\"image3\", \"tables_image\", \"".$uploadDir."\", \"\", \"".XOOPS_URL."\")'" );
		$imageTray->addElement($imageSelect);
		$imageTray->addElement( new Xoops\Form\Label( '', "<br /><img src='".XOOPS_URL."/".$uploadDir."/".$tableImage."' name='image3' id='image3' alt='' />" ) );		
		$fileSelectTray = new Xoops\Form\ElementTray('','<br />');
		$fileSelectTray->addElement(new Xoops\Form\File(XoopsLocale::A_UPLOAD, 'tables_image', $xoops->getModuleConfig('maxuploadsize')));
		$fileSelectTray->addElement(new Xoops\Form\Label(''));
		$imageTray->addElement($fileSelectTray);
		$tab1->addElement($imageTray);
		$tabtray->addElement($tab1);
		/**
         * Not important
         */
        $tab2 				= new Xoops\Form\Tab(TDMCreateLocale::OPTIONS_CHECK, 'options_check');
		$tableAutoIngrement = $obj->isNew() ? 1 : $obj->getVar('table_autoincrement');
		$tableAutoIngrement = new \Xoops\Form\RadioYesNo(TDMCreateLocale::TABLE_AUTOINCREMENT, 'table_autoincrement', $tableAutoIngrement);
		$tableAutoIngrement->setDescription(TDMCreateLocale::TABLE_AUTOINCREMENT_DESC);
		$tab2->addElement($tableAutoIngrement);
		$tableRadioCategory   = $obj->isNew() ? 0 : $obj->getVar('table_category');
        $tableRadioYNCategory = new \Xoops\Form\RadioYesNo(TDMCreateLocale::TABLE_CATEGORY, 'table_category', $tableRadioCategory);
        $tableRadioYNCategory->setDescription(TDMCreateLocale::TABLE_CATEGORY_DESC);
        $tab2->addElement($tableRadioYNCategory);
		$optionTray = new Xoops\Form\ElementTray(XoopsLocale::OPTIONS, '<br />');			
			$tableCheckboxAll = new Xoops\Form\CheckBox('', 'tablebox', 1);
			$tableCheckboxAll->addOption('allbox', TDMCreateLocale::C_CHECK_ALL);
			$tableCheckboxAll->setExtra(" onclick='xoopsCheckAll(\"form\", \"tablebox\");' ");
			$tableCheckboxAll->setClass('xo-checkall');
		$optionTray->addElement($tableCheckboxAll);
			$tableBlocks        = $obj->isNew() ? 0 : $obj->getVar('table_blocks');
			$displayBlocksCheck = new Xoops\Form\CheckBox(' ', 'table_blocks', $tableBlocks);
			$displayBlocksCheck->addOption(1, TDMCreateLocale::O_TABLE_BLOCKS);
		$optionTray->addElement($displayBlocksCheck);
			$tableAdmin        = $obj->isNew() ? 1 : $obj->getVar('table_admin');
			$displayAdminCheck = new Xoops\Form\CheckBox(' ', 'table_admin', $tableAdmin);
			$displayAdminCheck->addOption(1, TDMCreateLocale::O_TABLE_ADMIN);
		$optionTray->addElement($displayAdminCheck);
			$tableUser        = $obj->isNew() ? 1 : $obj->getVar('table_user');
			$displayUserCheck = new Xoops\Form\CheckBox(' ', 'table_user', $tableUser);
			$displayUserCheck->addOption(1, TDMCreateLocale::O_TABLE_USER);
		$optionTray->addElement($displayUserCheck);
			$tableSubmenu        = $obj->isNew() ? 0 : $obj->getVar('table_submenu');
			$displaySubmenuCheck = new Xoops\Form\CheckBox(' ', 'table_submenu', $tableSubmenu);
			$displaySubmenuCheck->addOption(1, TDMCreateLocale::O_TABLE_SUBMENU);
		$optionTray->addElement($displaySubmenuCheck);
			$tableSubmit        = $obj->isNew() ? 0 : $obj->getVar('table_submit');
			$displaySubmitCheck = new Xoops\Form\CheckBox(' ', 'table_submit', $tableSubmit);
			$displaySubmitCheck->addOption(1, TDMCreateLocale::O_TABLE_SUBMIT);
		$optionTray->addElement($displaySubmitCheck);
			$tableSearch       = $obj->isNew() ? 0 : $obj->getVar('table_search');
			$activeSearchCheck = new Xoops\Form\CheckBox(' ', 'table_search', $tableSearch);
			$activeSearchCheck->addOption(1, TDMCreateLocale::O_TABLE_SEARCH);
		$optionTray->addElement($activeSearchCheck);
			$tableComments       = $obj->isNew() ? 0 : $obj->getVar('table_comments');
			$activeCommentsCheck = new Xoops\Form\CheckBox(' ', 'table_comments', $tableComments);
			$activeCommentsCheck->addOption(1, TDMCreateLocale::O_TABLE_COMMENTS);
		$optionTray->addElement($activeCommentsCheck);
			$tableNotifications 	  = $obj->isNew() ? 0 : $obj->getVar('table_notifications');
			$activeNotificationsCheck = new Xoops\Form\CheckBox(' ', 'table_notifications', $tableNotifications);
			$activeNotificationsCheck->addOption(1, TDMCreateLocale::O_TABLE_NOTIFICATIONS);
		$optionTray->addElement($activeNotificationsCheck);
		    $tablePermissions        = $obj->isNew() ? 0 : $obj->getVar('table_permissions');
			$displayPermissionsCheck = new Xoops\Form\CheckBox(' ', 'table_permissions', $tablePermissions);
			$displayPermissionsCheck->addOption(1, TDMCreateLocale::O_TABLE_PERMISSIONS);
		$optionTray->addElement($displayPermissionsCheck);
			$tableRate        = $obj->isNew() ? 1 : $obj->getVar('table_rate');
			$displayRateCheck = new Xoops\Form\CheckBox(' ', 'table_rate', $tableRate);
			$displayRateCheck->addOption(1, TDMCreateLocale::O_TABLE_RATE);
		$optionTray->addElement($displayRateCheck);
			$tableTag        = $obj->isNew() ? 1 : $obj->getVar('table_tag');
			$displayTagCheck = new Xoops\Form\CheckBox(' ', 'table_tag', $tableTag);
			$displayTagCheck->addOption(1, TDMCreateLocale::O_TABLE_TAG);
		$optionTray->addElement($displayTagCheck);
			$tableBroken        = $obj->isNew() ? 1 : $obj->getVar('table_broken');
			$displayBrokenCheck = new Xoops\Form\CheckBox(' ', 'table_broken', $tableBroken);
			$displayBrokenCheck->addOption(1, TDMCreateLocale::O_TABLE_BROKEN);
		$optionTray->addElement($displayBrokenCheck);
			$tablePrint        = $obj->isNew() ? 1 : $obj->getVar('table_print');
			$displayPrintCheck = new Xoops\Form\CheckBox(' ', 'table_print', $tablePrint);
			$displayPrintCheck->addOption(1, TDMCreateLocale::O_TABLE_PRINT);
		$optionTray->addElement($displayPrintCheck);
			$tablePdf        = $obj->isNew() ? 0 : $obj->getVar('table_pdf');
			$displayPdfCheck = new Xoops\Form\CheckBox(' ', 'table_pdf', $tablePdf);
			$displayPdfCheck->addOption(1, TDMCreateLocale::O_TABLE_PDF);
		$optionTray->addElement($displayPdfCheck);
			$tableRss        = $obj->isNew() ? 0 : $obj->getVar('table_rss');
			$displayRssCheck = new Xoops\Form\CheckBox(' ', 'table_rss', $tableRss);
			$displayRssCheck->addOption(1, TDMCreateLocale::O_TABLE_RSS);
		$optionTray->addElement($displayRssCheck);
			$tableSingle        = $obj->isNew() ? 0 : $obj->getVar('table_single');
			$displaySingleCheck = new Xoops\Form\CheckBox(' ', 'table_single', $tableSingle);
			$displaySingleCheck->addOption(1, TDMCreateLocale::O_TABLE_SINGLE);
		$optionTray->addElement($displaySingleCheck);
			$tableVisit 	   = $obj->isNew() ? 0 : $obj->getVar('table_visit');
			$displayVisitCheck = new Xoops\Form\CheckBox(' ', 'table_visit', $tableVisit);
			$displayVisitCheck->addOption(1, TDMCreateLocale::O_TABLE_VISIT);
		$optionTray->addElement($displayVisitCheck);
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
            $this->addElement(new Xoops\Form\Hidden( 'table_id', $obj->getVar('table_id') ) );
        }
		
		$this->addElement($tabtray);
	}
}
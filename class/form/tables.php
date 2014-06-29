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

class TDMCreateTablesForm extends XoopsThemeForm
{ 
	/**
     * @param TDMCreateTables|XoopsObject $obj
     */
	public function __construct(TDMCreateTables &$obj)
	{	    
		$xoops = Xoops::getInstance();
	
		$title = $obj->isNew() ? sprintf(TDMCreateLocale::TABLE_ADD) : sprintf(TDMCreateLocale::TABLE_EDIT);
		
		parent::__construct($title, 'form', false, 'post', true);
        $this->setExtra('enctype="multipart/form-data"');
		
		if (!$obj->isNew()) {		
		    $this->addElement(new XoopsFormHidden('id', $obj->getVar('table_id')));
		}

        $modules_Handler = $xoops->getModuleHandler('modules');
    	$mods_select = new XoopsFormSelect(TDMCreateLocale::MODULES_LIST, 'table_mid', $obj->getVar('table_mid'));
    	$mods_select->addOptionArray($modules_Handler->getList());
    	$this->addElement($mods_select, true);		
		
		$table_name = new XoopsFormText(TDMCreateLocale::TABLE_NAME, 'table_name', 50, 255, $obj->getVar('table_name'));
		$table_name->setDescription(TDMCreateLocale::TABLE_NAME_DESC);
		$this->addElement($table_name, true);
		$table_fieldname = new XoopsFormText(TDMCreateLocale::TABLE_FIELD_NAME, 'table_fieldname', 3, 50, $obj->getVar('table_fieldname'));
		$table_fieldname->setDescription(TDMCreateLocale::TABLE_FIELD_NAME_DESC);
		$this->addElement($table_fieldname);
		$table_nbfield = new XoopsFormText(TDMCreateLocale::TABLE_FIELDS_NUMBER, 'table_nbfields', 2, 50, $obj->getVar('table_nbfields'));
		$table_nbfield->setDescription(TDMCreateLocale::TABLE_FIELDS_NUMBER_DESC);
		$this->addElement($table_nbfield, true);		
		// table_image	
		$table_image = $obj->getVar('table_image') ? $obj->getVar('table_image') : 'blank.gif';	
		$uploadir = 'media/xoops/images/icons/32';
		$imgtray = new XoopsFormElementTray(TDMCreateLocale::C_IMAGE,'<br />');
		$imgpath = sprintf(TDMCreateLocale::CF_IMAGE_PATH, './'.$uploadir.'/');
		$imageselect = new XoopsFormSelect($imgpath, 'tables_image', $table_image, 5);
		$image_array = XoopsLists::getImgListAsArray( XOOPS_ROOT_PATH.'/'.$uploadir );
		foreach( $image_array as $image ) {
			$imageselect->addOption("{$image}", $image);
		}
		$imageselect->setExtra( "onchange='showImgSelected(\"image3\", \"tables_image\", \"".$uploadir."\", \"\", \"".XOOPS_URL."\")'" );
		$imgtray->addElement($imageselect);
		$imgtray->addElement( new XoopsFormLabel( '', "<br /><img src='".XOOPS_URL."/".$uploadir."/".$table_image."' name='image3' id='image3' alt='' />" ) );		
		$fileseltray = new XoopsFormElementTray('','<br />');
		$fileseltray->addElement(new XoopsFormFile(XoopsLocale::A_UPLOAD, 'attachedfile', $xoops->getModuleConfig('maxuploadsize')));
		$fileseltray->addElement(new XoopsFormLabel(''));
		$imgtray->addElement($fileseltray);
		$this->addElement($imgtray);
		
		$options_tray = new XoopsFormElementTray(XoopsLocale::OPTIONS, '');
			$table_blocks = $obj->isNew() ? 0 : $obj->getVar('table_blocks');
			$check_blocks = new XoopsFormCheckBox(' ', "table_blocks", $table_blocks);
			$check_blocks->addOption(1, TDMCreateLocale::TABLE_BLOCKS);
			$options_tray->addElement($check_blocks);
			$table_display_admin = $obj->isNew() ? 0 : $obj->getVar('table_display_admin');
			$check_display_admin = new XoopsFormCheckBox(' ', "table_admin", $table_display_admin);
			$check_display_admin->addOption(1, TDMCreateLocale::TABLE_ADMIN);
			$options_tray->addElement($check_display_admin);
			$table_display_user = $obj->isNew() ? 0 : $obj->getVar('table_display_user');
			$check_display_user = new XoopsFormCheckBox(' ', "table_user", $table_display_user);
			$check_display_user->addOption(1, TDMCreateLocale::TABLE_USER);
			$options_tray->addElement($check_display_user);
			$table_submenu = $obj->isNew() ? 0 : $obj->getVar('table_submenu');
			$check_submenu = new XoopsFormCheckBox(' ', "table_submenu", $table_submenu);
			$check_submenu->addOption(1, TDMCreateLocale::TABLE_SUBMENU);
			$options_tray->addElement($check_submenu);
			$table_search = $obj->isNew() ? 0 : $obj->getVar('table_search');
			$check_search = new XoopsFormCheckBox(' ', "table_search", $table_search);
			$check_search->addOption(1, TDMCreateLocale::TABLE_SEARCH);
			$options_tray->addElement($check_search);
			$table_comments = $obj->isNew() ? 0 : $obj->getVar('table_comments');
			$check_comments = new XoopsFormCheckBox(' ', "table_comments", $table_comments);
			$check_comments->addOption(1, TDMCreateLocale::TABLE_COMMENTS);
			$options_tray->addElement($check_comments);
			$table_notify = $obj->isNew() ? 0 : $obj->getVar('table_notifications');
			$check_notify = new XoopsFormCheckBox(' ', "table_notifications", $table_notify);
			$check_notify->addOption(1, TDMCreateLocale::TABLE_NOTIFICATIONS);
			$options_tray->addElement($check_notify);
		$this->addElement($options_tray);			
		
		$this->addElement(new XoopsFormHidden('op', 'save'));
		$this->addElement(new XoopsFormButton('', 'submit', XoopsLocale::A_SUBMIT, 'submit'));
	}
}
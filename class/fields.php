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
 * @version         $Id: fields.php 10665 2012-12-27 10:14:15Z timgno $
 */	
defined('XOOPS_ROOT_PATH') or die("XOOPS root path not defined");

class TDMCreateFields extends XoopsObject
{ 
	/**
     * Constructor
     */
	public function __construct()
	{		
		$this->initVar('field_id', XOBJ_DTYPE_INT, null, true);
		$this->initVar('field_mid', XOBJ_DTYPE_INT, null);
		$this->initVar('field_tid', XOBJ_DTYPE_INT, null);
		$this->initVar('field_numb', XOBJ_DTYPE_INT, null);
		$this->initVar('field_name', XOBJ_DTYPE_TXTBOX, null);		
		$this->initVar('field_type', XOBJ_DTYPE_TXTBOX, null);
		$this->initVar('field_value', XOBJ_DTYPE_TXTBOX, null);
		$this->initVar('field_attribute', XOBJ_DTYPE_TXTBOX, null);
		$this->initVar('field_null', XOBJ_DTYPE_TXTBOX, null);
		$this->initVar('field_default', XOBJ_DTYPE_TXTBOX, null);
		$this->initVar('field_key', XOBJ_DTYPE_TXTBOX, null);
		$this->initVar('field_auto_increment', XOBJ_DTYPE_INT);
		$this->initVar('field_admin', XOBJ_DTYPE_INT);
		$this->initVar('field_user', XOBJ_DTYPE_INT);
		$this->initVar('field_block', XOBJ_DTYPE_INT);
		$this->initVar('field_mainfield', XOBJ_DTYPE_INT);
		$this->initVar('field_search', XOBJ_DTYPE_INT);
		$this->initVar('field_required', XOBJ_DTYPE_INT);        
	}	
}

class TDMCreateFieldsHandler extends XoopsPersistableObjectHandler 
{
	/**
     * @param null|XoopsDatabase $db
     */
	public function __construct(XoopsDatabase $db = null)
	{
		parent::__construct($db, 'tdmcreate_fields', 'tdmcreatefields', 'field_id', 'field_name');
	}
}
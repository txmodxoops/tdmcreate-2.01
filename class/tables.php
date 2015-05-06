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
 * @version         $Id: tables.php 10665 2012-12-27 10:14:15Z timgno $
 */	
defined('XOOPS_ROOT_PATH') or die("XOOPS root path not defined");

class TDMCreateTables extends XoopsObject
{ 
	/**
     * Constructor
     */
	public function __construct()
	{
		$this->initVar('table_id', XOBJ_DTYPE_INT, null, true);
		$this->initVar('table_mid', XOBJ_DTYPE_INT, null);
		$this->initVar('table_name', XOBJ_DTYPE_TXTBOX, null);
		$this->initVar('table_nbfields', XOBJ_DTYPE_INT, null);
		$this->initVar('table_fieldname', XOBJ_DTYPE_TXTBOX, null);				
		$this->initVar('table_image', XOBJ_DTYPE_TXTBOX, null);		
		$this->initVar('table_blocks', XOBJ_DTYPE_INT, null);
		$this->initVar('table_admin', XOBJ_DTYPE_INT, null);
		$this->initVar('table_user', XOBJ_DTYPE_INT, null);
		$this->initVar('table_submenu', XOBJ_DTYPE_INT, null);
		$this->initVar('table_search', XOBJ_DTYPE_INT, null);
		$this->initVar('table_comments', XOBJ_DTYPE_INT, null);
		$this->initVar('table_notifications', XOBJ_DTYPE_INT, null);
	}	
}

class TDMCreateTablesHandler extends XoopsPersistableObjectHandler 
{
    /**
     * @param null|XoopsDatabase $db
     */
	public function __construct(XoopsDatabase $db = null)
	{
		parent::__construct($db, 'tdmcreate_tables', 'tdmcreatetables', 'table_id', 'table_name');
	}
}
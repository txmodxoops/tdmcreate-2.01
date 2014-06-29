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
 * @version         $Id: fieldattributes.php 10665 2012-12-27 10:14:15Z timgno $
 */
defined('XOOPS_ROOT_PATH') or die("XOOPS root path not defined");

class TDMCreateFieldattributes extends XoopsObject
{ 
	/**
     * Constructor
     */
	public function __construct()
	{
		$this->XoopsObject();		
        $this->initVar("fieldattributes_value",XOBJ_DTYPE_TXTBOX, null, false, 25);		
		$this->initVar("fieldattributes_name",XOBJ_DTYPE_TXTBOX, null, false, 255);	       		
	}
}

class TDMCreateFieldattributesHandler extends XoopsPersistableObjectHandler 
{
    /**
     * @param null|XoopsDatabase $db
     */
    public function __construct(XoopsDatabase $db = null) 
    {
        parent::__construct($db, "tdmcreate_fieldattributes", 'tdmcreatefieldattributes', 'fieldattributes_value', 'fieldattributes_name');
    }
}
?>
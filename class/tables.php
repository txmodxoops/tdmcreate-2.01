<?php   
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/
use Xoops\Core\Database\Connection;
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
/**
 * Class TDMCreateTables
 */
class TDMCreateTables extends XoopsObject
{ 
	/**
     * Constructor
     */
	public function __construct()
	{
		$this->initVar('table_id', XOBJ_DTYPE_INT);
        $this->initVar('table_mid', XOBJ_DTYPE_INT);
        $this->initVar('table_category', XOBJ_DTYPE_INT);
        $this->initVar('table_name', XOBJ_DTYPE_TXTBOX);
		$this->initVar('table_solename', XOBJ_DTYPE_TXTBOX);
        $this->initVar('table_fieldname', XOBJ_DTYPE_TXTBOX);
        $this->initVar('table_nbfields', XOBJ_DTYPE_INT);
        $this->initVar('table_order', XOBJ_DTYPE_INT);
        $this->initVar('table_image', XOBJ_DTYPE_TXTBOX);
        $this->initVar('table_autoincrement', XOBJ_DTYPE_INT);
        $this->initVar('table_blocks', XOBJ_DTYPE_INT);
        $this->initVar('table_admin', XOBJ_DTYPE_INT);
        $this->initVar('table_user', XOBJ_DTYPE_INT);
        $this->initVar('table_submenu', XOBJ_DTYPE_INT);
        $this->initVar('table_submit', XOBJ_DTYPE_INT);
        $this->initVar('table_tag', XOBJ_DTYPE_INT);
        $this->initVar('table_broken', XOBJ_DTYPE_INT);
        $this->initVar('table_search', XOBJ_DTYPE_INT);
        $this->initVar('table_comments', XOBJ_DTYPE_INT);
        $this->initVar('table_notifications', XOBJ_DTYPE_INT);
        $this->initVar('table_permissions', XOBJ_DTYPE_INT);
        $this->initVar('table_rate', XOBJ_DTYPE_INT);
        $this->initVar('table_print', XOBJ_DTYPE_INT);
        $this->initVar('table_pdf', XOBJ_DTYPE_INT);
        $this->initVar('table_rss', XOBJ_DTYPE_INT);
        $this->initVar('table_single', XOBJ_DTYPE_INT);
        $this->initVar('table_visit', XOBJ_DTYPE_INT);
	}
	
	public function getValues($keys = null, $format = null, $maxDepth = null)
    {
        $ret 					= parent::getValues($keys, $format, $maxDepth);
        $ret['id']				= $this->getVar('table_id');
		$ret['name']	 		= $this->getVar('table_name');
		$ret['image'] 			= $this->getVar('table_image');
        $ret['nbfields'] 		= number_format($this->getVar('table_nbfields'), 1);
        $ret['admin'] 			= $this->getVar('table_admin');
		$ret['user'] 			= $this->getVar('table_user');
		$ret['blocks'] 			= $this->getVar('table_blocks');
		$ret['submenu'] 		= $this->getVar('table_submenu');
		$ret['search'] 			= $this->getVar('table_search');
		$ret['comments'] 		= $this->getVar('table_comments');
		$ret['notifications'] 	= $this->getVar('table_notifications');
		$ret['permissions'] 	= $this->getVar('table_permissions');
        return $ret;
    }
	
	public function toArray()
    {
        $ret = parent::getValues();
        unset($ret['dohtml']);
        return $ret;
    }

	public function getNewId()
    {
        return Xoops::getInstance()->db()->getInsertId();
    }
}
/**
 * Class TDMCreateTablesHandler
 */
class TDMCreateTablesHandler extends XoopsPersistableObjectHandler 
{
    /**
     * @param null|Connection $db
     */
	public function __construct(Connection $db = null)
	{
		parent::__construct($db, 'tdmcreate_tables', 'tdmcreatetables', 'table_id', 'table_name');
	}
	
	public function getAllTables($start = 0, $limit = 0, $sort = 'table_id ASC, table_name', $order = 'ASC')
    {
        $criteria = new CriteriaCompo();
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setStart($start);
        $criteria->setLimit($limit);
        return parent::getAll($criteria);
    }

    public function getCountTables($start = 0, $limit = 0, $sort = 'table_id ASC, table_name', $order = 'ASC')
    {
        $criteria = new CriteriaCompo();
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setStart($start);
        $criteria->setLimit($limit);
        return parent::getCount($criteria);
    }
}
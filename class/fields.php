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
 * @version         $Id: fields.php 10665 2012-12-27 10:14:15Z timgno $
 */	
/**
 * Class TDMCreateFields
 */
class TDMCreateFields extends XoopsObject
{ 
	/**
     * Constructor
     */
	public function __construct()
	{		
		$this->initVar('field_id', XOBJ_DTYPE_INT);
        $this->initVar('field_mid', XOBJ_DTYPE_INT);
        $this->initVar('field_tid', XOBJ_DTYPE_INT);
        $this->initVar('field_order', XOBJ_DTYPE_INT);
        $this->initVar('field_name', XOBJ_DTYPE_TXTBOX);
        $this->initVar('field_type', XOBJ_DTYPE_TXTBOX);
        $this->initVar('field_value', XOBJ_DTYPE_TXTBOX);
        $this->initVar('field_attribute', XOBJ_DTYPE_TXTBOX);
        $this->initVar('field_null', XOBJ_DTYPE_TXTBOX);
        $this->initVar('field_default', XOBJ_DTYPE_TXTBOX);
        $this->initVar('field_key', XOBJ_DTYPE_TXTBOX);
        $this->initVar('field_element', XOBJ_DTYPE_TXTBOX);
        $this->initVar('field_parent', XOBJ_DTYPE_INT);
        $this->initVar('field_inlist', XOBJ_DTYPE_INT);
        $this->initVar('field_inform', XOBJ_DTYPE_INT);
        $this->initVar('field_admin', XOBJ_DTYPE_INT);
        $this->initVar('field_user', XOBJ_DTYPE_INT);
        $this->initVar('field_block', XOBJ_DTYPE_INT);
        $this->initVar('field_main', XOBJ_DTYPE_INT);
        $this->initVar('field_search', XOBJ_DTYPE_INT);
        $this->initVar('field_required', XOBJ_DTYPE_INT);    
	}
	/**
     * Get Values
     */
	public function getValues($keys = null, $format = null, $maxDepth = null)
    {        
		$ret 			 = parent::getValues($keys, $format, $maxDepth);
        $ret['id']		 = $this->getVar('field_id');
		$ret['name']	 = $this->getVar('field_name');
        $ret['parent'] 	 = $this->getVar('field_parent');
		$ret['inlist'] 	 = $this->getVar('field_inlist');
		$ret['inform'] 	 = $this->getVar('field_inform');
		$ret['admin'] 	 = $this->getVar('field_admin');	
		$ret['user'] 	 = $this->getVar('field_user');
		$ret['block'] 	 = $this->getVar('field_block');
		$ret['main'] 	 = $this->getVar('field_main');
		$ret['search'] 	 = $this->getVar('field_search');
		$ret['required'] = $this->getVar('field_required');
        return $ret;
    }
	/**
     * To Array
     */
	public function toArray()
    {
        $ret = parent::getValues();
        return $ret;
    }
}
/**
 * Class TDMCreateFieldsHandler
 */
class TDMCreateFieldsHandler extends XoopsPersistableObjectHandler 
{
	/**
     * @param null|Connection $db
     */
	public function __construct(Connection $db = null)
	{
		parent::__construct($db, 'tdmcreate_fields', 'tdmcreatefields', 'field_id', 'field_name');
	}	
	/**
     * Get All Fields
     */
	public function getAllFields($start = 0, $limit = 0, $sort = 'field_id ASC, field_name', $order = 'ASC')
    {
        $criteria = new CriteriaCompo();
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setStart($start);
        $criteria->setLimit($limit);
        return parent::getAll($criteria);
    }
	/**
     * Get All Fields By Table Id
     */
	public function getAllFieldsByTableId($mid, $tid, $start = 0, $limit = 0, $sort = 'field_id ASC, field_name', $order = 'ASC')
    {
        $criteria = new CriteriaCompo();
		$criteria->add(new Criteria('field_mid', $mid));
		$criteria->add(new Criteria('field_tid', $tid));
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setStart($start);
        $criteria->setLimit($limit);
        return parent::getAll($criteria);
    }
	/**
     * Get Count Tables
     */
    public function getCountFields($mid, $tid, $start = 0, $limit = 0, $sort = 'field_id ASC, field_name', $order = 'ASC')
    {
        $criteria = new CriteriaCompo();
		$criteria->add(new Criteria('field_mid', $mid));
		$criteria->add(new Criteria('field_tid', $tid));
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setStart($start);
        $criteria->setLimit($limit);
        return parent::getCount($criteria);
    }
}
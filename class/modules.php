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
 * @version         $Id: modules.php 10665 2012-12-27 10:14:15Z timgno $
 */
/**
 * Class TDMCreateModules
 */
class TDMCreateModules extends XoopsObject
{ 
	/**
     * Options
     */
	public $options = array(
        'extension', 'blocks', 'admin', 'user', 'search',
        'comments', 'notifications', 'permissions', 'root'
    );
	/**
     * Constructor
     */
	public function __construct()
	{	
	    $helper = Xoops\Module\Helper::getHelper('tdmcreate');	
		
		$this->initVar('mod_id', XOBJ_DTYPE_INT);
        $this->initVar('mod_name', XOBJ_DTYPE_TXTBOX, $helper->getConfig('name'));
		$this->initVar('mod_isextension', XOBJ_DTYPE_INT, $helper->getConfig('isextension'));
        $this->initVar('mod_dirname', XOBJ_DTYPE_TXTBOX, $helper->getConfig('dirname'));
        $this->initVar('mod_version', XOBJ_DTYPE_TXTBOX, $helper->getConfig('version'));
        $this->initVar('mod_since', XOBJ_DTYPE_TXTBOX, $helper->getConfig('since'));
        $this->initVar('mod_min_php', XOBJ_DTYPE_TXTBOX, $helper->getConfig('min_php'));
        $this->initVar('mod_min_xoops', XOBJ_DTYPE_TXTBOX, $helper->getConfig('min_xoops'));
        $this->initVar('mod_min_admin', XOBJ_DTYPE_TXTBOX, $helper->getConfig('min_admin'));
        $this->initVar('mod_min_mysql', XOBJ_DTYPE_TXTBOX, $helper->getConfig('min_mysql'));
        $this->initVar('mod_description', XOBJ_DTYPE_TXTAREA, $helper->getConfig('description'));
        $this->initVar('mod_author', XOBJ_DTYPE_TXTBOX, $helper->getConfig('author'));
        $this->initVar('mod_author_mail', XOBJ_DTYPE_TXTBOX, $helper->getConfig('author_email'));
        $this->initVar('mod_author_website_url', XOBJ_DTYPE_TXTBOX, $helper->getConfig('author_website_url'));
        $this->initVar('mod_author_website_name', XOBJ_DTYPE_TXTBOX, $helper->getConfig('author_website_name'));
        $this->initVar('mod_credits', XOBJ_DTYPE_TXTBOX, $helper->getConfig('credits'));
        $this->initVar('mod_license', XOBJ_DTYPE_TXTBOX, $helper->getConfig('license'));
        $this->initVar('mod_release_info', XOBJ_DTYPE_TXTBOX, $helper->getConfig('release_info'));
        $this->initVar('mod_release_file', XOBJ_DTYPE_TXTBOX, $helper->getConfig('release_file'));
        $this->initVar('mod_manual', XOBJ_DTYPE_TXTBOX, $helper->getConfig('manual'));
        $this->initVar('mod_manual_file', XOBJ_DTYPE_TXTBOX, $helper->getConfig('manual_file'));
        $this->initVar('mod_image', XOBJ_DTYPE_TXTBOX, null);
        $this->initVar('mod_demo_site_url', XOBJ_DTYPE_TXTBOX, $helper->getConfig('demo_site_url'));
        $this->initVar('mod_demo_site_name', XOBJ_DTYPE_TXTBOX, $helper->getConfig('demo_site_name'));
        $this->initVar('mod_support_url', XOBJ_DTYPE_TXTBOX, $helper->getConfig('support_url'));
        $this->initVar('mod_support_name', XOBJ_DTYPE_TXTBOX, $helper->getConfig('support_name'));
        $this->initVar('mod_website_url', XOBJ_DTYPE_TXTBOX, $helper->getConfig('website_url'));
        $this->initVar('mod_website_name', XOBJ_DTYPE_TXTBOX, $helper->getConfig('website_name'));
        $this->initVar('mod_release', XOBJ_DTYPE_TXTBOX, $helper->getConfig('release_date'));
        $this->initVar('mod_status', XOBJ_DTYPE_TXTBOX, $helper->getConfig('status'));
        $this->initVar('mod_admin', XOBJ_DTYPE_INT, $helper->getConfig('display_admin'));
        $this->initVar('mod_user', XOBJ_DTYPE_INT, $helper->getConfig('display_user'));
        $this->initVar('mod_blocks', XOBJ_DTYPE_INT, $helper->getConfig('active_blocks'));
        $this->initVar('mod_search', XOBJ_DTYPE_INT, $helper->getConfig('active_search'));
        $this->initVar('mod_comments', XOBJ_DTYPE_INT, $helper->getConfig('active_comments'));
        $this->initVar('mod_notifications', XOBJ_DTYPE_INT, $helper->getConfig('active_notifications'));
        $this->initVar('mod_permissions', XOBJ_DTYPE_INT, $helper->getConfig('active_permissions'));
        $this->initVar('mod_inroot_copy', XOBJ_DTYPE_INT, $helper->getConfig('inroot_copy'));
        $this->initVar('mod_donations', XOBJ_DTYPE_TXTBOX, $helper->getConfig('donations'));
        $this->initVar('mod_subversion', XOBJ_DTYPE_TXTBOX, $helper->getConfig('subversion'));
	}

	public function getValues($keys = null, $format = null, $maxDepth = null)
    {
        $tdmcreate 				= TDMCreate::getInstance();
        $ret 					= parent::getValues($keys, $format, $maxDepth);
        $ret['id']	 			= $this->getVar('mod_id');
		$ret['name']	 		= $this->getVar('mod_name');
        $ret['version'] 		= number_format($this->getVar('mod_version'), 2);
        $ret['image'] 			= TDMC_UPLOAD_IMAGES_MODULES_URL .'/'. $this->getVar('mod_image');
        $ret['release'] 		= XoopsLocale::formatTimestamp($this->getVar('mod_release'), $tdmcreate->getConfig('release_date'));
        $ret['status'] 			= $this->getVar('mod_status');
        $ret['admin'] 			= $this->getVar('mod_admin');
		$ret['user'] 			= $this->getVar('mod_user');
		$ret['blocks'] 			= $this->getVar('mod_blocks');
		$ret['search'] 			= $this->getVar('mod_search');
		$ret['comments'] 		= $this->getVar('mod_comments');
		$ret['notifications'] 	= $this->getVar('mod_notifications');
		$ret['permissions'] 	= $this->getVar('mod_permissions');
        return $ret;
    }
	
	public function toArray()
    {
        $ret = parent::getValues();
        return $ret;
    }
	
	/**
     * Get Options
     */
	public function getOptions()
    {
        $ret = array();
		if ($this->getVar('table_isextension') == 1) {
            array_push($ret, 'extension');
        }
        if ($this->getVar('mod_blocks') == 1) {
            array_push($ret, 'blocks');
        }
        if ($this->getVar('mod_admin') == 1) {
            array_push($ret, 'admin');
        }
		if ($this->getVar('mod_user') == 1) {
            array_push($ret, 'user');
        }       
        if ($this->getVar('mod_search') == 1) {
            array_push($ret, 'search');
        }
		 if ($this->getVar('mod_comments') == 1) {
            array_push($ret, 'comments');
        }
        if ($this->getVar('mod_notifications') == 1) {
            array_push($ret, 'notifications');
        }
		if ($this->getVar('mod_permissions') == 1) {
            array_push($ret, 'permissions');
        }
        if ($this->getVar('mod_inroot_copy') == 1) {
            array_push($ret, 'root');
        }       
        return $ret;
    }
}
/**
 * Class TDMCreateModulesHandler
 */
class TDMCreateModulesHandler extends XoopsPersistableObjectHandler 
{
    /**
     * @param null|Connection $db
     */
	public function __construct(Connection $db = null)
	{
		parent::__construct($db, 'tdmcreate_modules', 'tdmcreatemodules', 'mod_id', 'mod_name');
	}
	
	public function getAllModules($start = 0, $limit = 0, $sort = 'mod_id ASC, mod_name', $order = 'ASC')
    {
        $criteria = new CriteriaCompo();
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setStart($start);
        $criteria->setLimit($limit);
        return parent::getAll($criteria);
    }

    public function getCountModules($start = 0, $limit = 0, $sort = 'mod_id ASC, mod_name', $order = 'ASC')
    {
        $criteria = new CriteriaCompo();
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setStart($start);
        $criteria->setLimit($limit);
        return parent::getCount($criteria);
    }
}
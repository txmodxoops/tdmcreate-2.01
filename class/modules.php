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
 * @version         $Id: modules.php 10665 2012-12-27 10:14:15Z timgno $
 */
defined('XOOPS_ROOT_PATH') or die("XOOPS root path not defined");

class TDMCreateModules extends XoopsObject
{ 
	/**
     * Constructor
     */
	public function __construct()
	{	
	    $xoops = Xoops::getInstance();
	
		$this->initVar('mod_id', XOBJ_DTYPE_INT, null, true);        
        $this->initVar('mod_name',XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('name'));
		$this->initVar('mod_isextension',XOBJ_DTYPE_INT,$xoops->getModuleConfig('is_extension'));
		$this->initVar('mod_version',XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('version'));
		$this->initVar('mod_description',XOBJ_DTYPE_TXTAREA, $xoops->getModuleConfig('description'));
		$this->initVar('mod_author',XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('author'));
		$this->initVar('mod_author_mail',XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('author_email'));
		$this->initVar('mod_author_website_url',XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('author_website_url'));
        $this->initVar('mod_author_website_name',XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('author_website'));
		$this->initVar('mod_credits',XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('credits'));
		$this->initVar('mod_license',XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('license'));
		$this->initVar('mod_release_info',XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('release_info'));
		$this->initVar('mod_release_file',XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('release_file'));
		$this->initVar('mod_manual',XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('manual'));
		$this->initVar('mod_manual_file',XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('manual_file'));
		$this->initVar('mod_image',XOBJ_DTYPE_TXTBOX, null);
		$this->initVar('mod_demo_site_url',XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('demo_site_url'));
		$this->initVar('mod_demo_site_name',XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('demo_site_name'));
		$this->initVar('mod_support_url',XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('support_url'));
        $this->initVar('mod_support_name',XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('support_name'));
		$this->initVar('mod_website_url',XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('website_url'));
		$this->initVar('mod_website_name',XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('website_name'));
		$this->initVar('mod_release',XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('release'));
		$this->initVar('mod_status',XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('status'));
		$this->initVar('mod_admin',XOBJ_DTYPE_INT,$xoops->getModuleConfig('display_admin'));
		$this->initVar('mod_user',XOBJ_DTYPE_INT, $xoops->getModuleConfig('display_user'));
		$this->initVar('mod_submenu', XOBJ_DTYPE_INT, $xoops->getModuleConfig('display_submenu'));
		$this->initVar('mod_search',XOBJ_DTYPE_INT, $xoops->getModuleConfig('active_search'));
		$this->initVar('mod_comments',XOBJ_DTYPE_INT, $xoops->getModuleConfig('active_comments'));	
		$this->initVar('mod_notifies', XOBJ_DTYPE_INT, $xoops->getModuleConfig('active_notifies'));	
		$this->initVar('mod_paypal_button', XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('paypal_button'));
		$this->initVar('mod_subversion', XOBJ_DTYPE_TXTBOX, $xoops->getModuleConfig('subversion'));
	}	
}

class TDMCreateModulesHandler extends XoopsPersistableObjectHandler 
{
    /**
     * @param null|XoopsDatabase $db
     */
	public function __construct(XoopsDatabase $db = null)
	{
		parent::__construct($db, 'tdmcreate_modules', 'tdmcreatemodules', 'mod_id', 'mod_name');
	}
}
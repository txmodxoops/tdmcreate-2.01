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
 * @author          TXMod Xoops (aka Timgno)
 * @version         $Id: helper.php 10665 2012-12-27 10:14:15Z timgno $
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

class TDMCreate extends Xoops_Module_Helper_Abstract
{
    /**
     * Init the module
     *
     * @return null|void
     */
    public function init()
    {
        $this->setDirname('tdmcreate');
    }

    /**
     * @return TDMCreate
     */
    static function getInstance()
    {
        return parent::getInstance();
    }

    /**
     * @return TDMCreateTDMCreate_modulesHandler
     */
    public function getHandlerModules()
    {
        return $this->getHandler('modules');
    }

    /**
     * @return TDMCreateTDMCreate_tablesHandler
     */
    public function getHandlerTables()
    {
        return $this->getHandler('tables');
    }

    /**
     * @return TDMCreateTDMCreate_fieldsHandler
     */
    public function getHandlerFields()
    {
        return $this->getHandler('fields');
    }   
	
	/**
     * @return TDMCreateTDMCreate_importHandler
     */
    public function getHandlerImport()
    {
        return $this->getHandler('import');
    }   
	
	/**
     * @return TDMCreateTDMCreate_fieldtypeHandler
     */
    public function getHandlerFieldType()
    {
        return $this->getHandler('fieldtype');
    }   
	
	/**
     * @return TDMCreateTDMCreate_fieldattributesHandler
     */
    public function getHandlerFieldAttributes()
    {
        return $this->getHandler('fieldattributes');
    }   
	
	/**
     * @return TDMCreateTDMCreate_fieldnullHandler
     */
    public function getHandlerFieldNull()
    {
        return $this->getHandler('fieldnull');
    }   
	
	/**
     * @return TDMCreateTDMCreate_fieldkeyHandler
     */
    public function getHandlerFieldKey()
    {
        return $this->getHandler('fieldkey');
    }   
	
	/**
     * @return TDMCreateTDMCreate_fieldelementsHandler
     */
    public function getHandlerFieldElements()
    {
        return $this->getHandler('fieldelements');
    } 	
}
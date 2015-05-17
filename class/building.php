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
 * @author          Timgno <txmodxoops@gmail.com>
 * @version         $Id: building.php 10665 2012-12-27 10:14:15Z timgno $
 */
/**
 * Class TDMCreateBuilding
 */
class TDMCreateBuilding extends Xoops\Form\ThemeForm
{
    /*
    *  @public function constructor class
    *  @param null
    */
    /**
     *
     */
    public function __construct()
    {
        $helper = TDMCreate::getInstance();
        $xoops = $helper->xoops();
        $xoops->theme()->addStylesheet('modules/tdmcreate/assets/css/styles.css');
		
		parent::__construct(TDMCreateLocale::BUILDING_TITLE, 'form', 'building.php', 'post', true, 'raw');
		
		$modulesHandler =& $helper->getModulesHandler()->getObjects(null);
		$modulesSelect  = new Xoops\Form\Select(TDMCreateLocale::BUILDING_MODULES, 'mod_id', 'mod_id');
		$modulesSelect->addOption(0, TDMCreateLocale::BUILDING_SELECT_DEFAULT);
		//$modulesSelect->addOptionArray($modulesHandler->getList());
		foreach ($modulesHandler as $mod) {
            $modulesSelect->addOption($mod->getVar('mod_id'), $mod->getVar('mod_name'));
        }
		$this->addElement($modulesSelect, true);
		
		$this->addElement(new Xoops\Form\Hidden('op', 'build'));
		$this->addElement(new Xoops\Form\Button(XoopsLocale::REQUIRED . ' <sup class="red bold">*</sup>', 'submit', XoopsLocale::A_SUBMIT, 'submit'));
    }

    /*
    *  @static function &getInstance
    *  @param null
    */
    /**
     * @return TDMCreateBuilding
     */
    public static function &getInstance()
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }
}
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
 * tdmcreate setting.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 *
 * @since           2.6.0
 *
 * @author          Team Developement Settings Xoops (AKA TDM)
 *
 * @version         $Id: settings.php 13060 2015-05-12 19:29:44Z timgno $
 */
defined('XOOPS_ROOT_PATH') or die('XOOPS root path not defined');

class TDMCreateSettingsForm extends Xoops\Form\ThemeForm
{
    /**
     * @param TDMCreateSettings|XoopsObject $obj
     */
    public function __construct(TDMCreateSettings &$obj)
    {
        $helper = TDMCreate::getInstance();
        $xoops = $helper->xoops();
        $xoops->theme()->addStylesheet('settings/tdmcreate/assets/css/styles.css');
        //
        $title = $obj->isNew() ? sprintf(TDMCreateLocale::A_ADD_MODULE) : sprintf(TDMCreateLocale::A_EDIT_MODULE);
        parent::__construct($title, 'form', 'settings.php', 'post', true, 'raw');
        //
        $tabtray = new Xoops\Form\TabTray('', 'uniqueid', $xoops->getModuleConfig('jquery_theme', 'system'));
        //
        $tab1 = new Xoops\Form\Tab(TDMCreateLocale::IMPORTANT, 'important');
        // Name of Module
        $tab1->setDescription(TDMCreateLocale::C_MODULE_OR_EXTENSION_DESC);
        $tab1->addElement(new Xoops\Form\Text(TDMCreateLocale::C_NAME, 'set_name', 30, 155, $obj->getVar('set_name')), true);
        $tab1->addElement(new Xoops\Form\Text(TDMCreateLocale::C_DIRECTORY_NAME, 'set_dirname', 30, 155, $obj->getVar('set_dirname')), true);
        // Version setting
        $tab1->addElement(new Xoops\Form\Text(TDMCreateLocale::C_VERSION, 'set_version', 2, 4, $obj->getVar('set_version')), true);
        $tab1->addElement(new Xoops\Form\Text(TDMCreateLocale::C_SINCE, 'set_since', 2, 4, $obj->getVar('set_since')), true);
        $tab1->addElement(new Xoops\Form\Text(TDMCreateLocale::C_MIN_PHP, 'set_min_php', 2, 4, $obj->getVar('set_min_php')), true);
        $tab1->addElement(new Xoops\Form\Text(TDMCreateLocale::C_MIN_XOOPS, 'set_min_xoops', 2, 4, $obj->getVar('set_min_xoops')), true);
        $tab1->addElement(new Xoops\Form\Text(TDMCreateLocale::C_MIN_ADMIN, 'set_min_admin', 2, 4, $obj->getVar('set_min_admin')), true);
        $tab1->addElement(new Xoops\Form\Text(TDMCreateLocale::C_MIN_MYSQL, 'set_min_mysql', 2, 4, $obj->getVar('set_min_mysql')), true);
        // Editor
        $editorConfigs = array();
        $editorConfigs['name'] = 'set_description';
        $editorConfigs['value'] = $obj->getVar('set_description', 'e');
        $editorConfigs['rows'] = 4;
        $editorConfigs['cols'] = 80;
        $editorConfigs['editor'] = $xoops->getModuleConfig('editor');
        $tab1->addElement(new Xoops\Form\Editor(XoopsLocale::C_DESCRIPTION, 'set_description', $editorConfigs), true);
        // Author setting
        $tab1->addElement(new Xoops\Form\Text(XoopsLocale::C_AUTHOR, 'set_author', 50, 255, $obj->getVar('set_author')), true);
        $tab1->addElement(new Xoops\Form\Text(TDMCreateLocale::C_LICENSE, 'set_license', 50, 255, $obj->getVar('set_license')), true);
        $tabtray->addElement($tab1);
        //
        $tab2 = new Xoops\Form\Tab(TDMCreateLocale::CREATE_LOGO, 'create_logo');
        $settingImage = $obj->getVar('set_image') ? $obj->getVar('set_image') : 'default.png';
        $uploadir = 'uploads/tdmcreate/images/settings';
        $imgtray = new Xoops\Form\ElementTray(TDMCreateLocale::C_IMAGE, '<br /><br />');
        $imgpath = sprintf(TDMCreateLocale::CF_IMAGE_PATH, './'.$uploadir.'/');
        $imageselect = new Xoops\Form\Select($imgpath, 'settings_image', $settingImage);
        $image_array = XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH.'/'.$uploadir);
        foreach ($image_array as $image) {
            $imageselect->addOption("$image", $image);
        }
        $imageselect->setExtra("onchange='showImgSelected(\"image3\", \"settings_image\", \"".$uploadir.'", "", "'.XOOPS_URL."\")'");
        $imgtray->addElement($imageselect);
        $imgtray->addElement(new XoopsFormLabel('', "<br /><img src='".XOOPS_URL.'/'.$uploadir.'/'.$settingImage."' name='image3' id='image3' alt='' />"));
        $fileseltray = new Xoops\Form\ElementTray('', '<br />');
        $fileseltray->addElement(new XoopsFormFile(XoopsLocale::A_UPLOAD, 'settings_image', $xoops->getModuleConfig('maxuploadsize')));
        $fileseltray->addElement(new XoopsFormLabel(''));
        $imgtray->addElement($fileseltray);
        $tab2->addElement($imgtray, true);
        $tabtray->addElement($tab2);
        //
        $tab3 = new Xoops\Form\Tab(TDMCreateLocale::OPTIONS_CHECK, 'options_check');
        $optionTray = new Xoops\Form\ElementTray(TDMCreateLocale::C_OPTIONS, '<br />');
        $settingCheckboxAll = new Xoops\Form\CheckBox('', 'settingbox', 1);
        $settingCheckboxAll->addOption('allbox', TDMCreateLocale::C_CHECK_ALL);
        $settingCheckboxAll->setExtra(" onclick='xoopsCheckGroup(\"form\", \"settingbox\" , \"setting_option[]\");' ");
        $settingCheckboxAll->setClass('xo-checkall');
        $optionTray->addElement($settingCheckboxAll);
        $settingOption = $obj->getSettingsOptions();
        $checkbox = new Xoops\Form\Checkbox('<hr />', 'setting_option', $settingOption, false);
        $checkbox->setDescription(TDMCreateLocale::MODULE_OPTIONS_DESC);
        foreach ($obj->optionsSettings as $option) {
            $checkbox->addOption($option, Xoops_Locale::translate('O_MODULE_'.strtoupper($option), 'tdmcreate'));
        }
        $optionTray->addElement($checkbox);
        $tab3->addElement($optionTray);
        $tabtray->addElement($tab3);
        /*
         * Not important
         */
        $tab4 = new Xoops\Form\Tab(TDMCreateLocale::NOT_IMPORTANT, 'not_important');

        $tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_AUTHOR_MAIL, 'set_author_mail', 50, 255, $obj->getVar('set_author_mail')));
        $tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_AUTHOR_WEBSITE_URL, 'set_author_website_url', 50, 255, $obj->getVar('set_author_website_url')));
        $tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_AUTHOR_WEBSITE_NAME, 'set_author_website_name', 50, 255, $obj->getVar('set_author_website_name')));
        $tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_CREDITS, 'set_credits', 50, 255, $obj->getVar('set_credits')));
        $tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_RELEASE_INFO, 'set_release_info', 50, 255, $obj->getVar('set_release_info')));
        $tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_RELEASE_FILE, 'set_release_file', 50, 255, $obj->getVar('set_release_file')));
        $tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_MANUAL, 'set_manual', 50, 255, $obj->getVar('set_manual')));
        $tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_MANUAL_FILE, 'set_manual_file', 50, 255, $obj->getVar('set_manual_file')));
        $tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_DEMO_SITE_URL, 'set_demo_site_url', 50, 255, $obj->getVar('set_demo_site_url')));
        $tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_DEMO_SITE_NAME, 'set_demo_site_name', 50, 255, $obj->getVar('set_demo_site_name')));
        $tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_SUPPORT_URL, 'set_support_url', 50, 255, $obj->getVar('set_support_url')));
        $tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_SUPPORT_NAME, 'set_support_name', 50, 255, $obj->getVar('set_support_name')));
        $tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_WEBSITE_URL, 'set_website_url', 50, 255, $obj->getVar('set_website_url')));
        $tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_WEBSITE_NAME, 'set_website_name', 50, 255, $obj->getVar('set_website_name')));
        $tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_RELEASE, 'set_release', 50, 255, $obj->getVar('set_release')));
        $tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_STATUS, 'set_status', 50, 255, $obj->getVar('set_status')));

        $tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_DONATIONS, 'set_donations', 50, 255, $obj->getVar('set_donations')));
        $tab4->addElement(new Xoops\Form\Text(TDMCreateLocale::C_SUBVERSION, 'set_subversion', 50, 255, $obj->getVar('set_subversion')));

        /*
         * Button submit
         */
        $buttonTray = new Xoops\Form\ElementTray('', '');
        $buttonTray->addElement(new Xoops\Form\Hidden('op', 'save'));

        $button = new Xoops\Form\Button('', 'submit', XoopsLocale::A_SUBMIT, 'submit');
        $button->setClass('btn');
        $buttonTray->addElement($button);
        $tab4->addElement($buttonTray);
        $tabtray->addElement($tab4);

        if (!$obj->isNew()) {
            $this->addElement(new Xoops\Form\Hidden('set_id', $obj->getVar('set_id')));
        }

        $this->addElement($tabtray);
    }
}

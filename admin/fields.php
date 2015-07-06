<?php

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/
use Xoops\Core\Request;

/**
 * tdmcreate module.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 *
 * @since           2.6.0
 *
 * @author          TDM Xoops (AKA Developers)
 *
 * @version         $Id: fields.php 10665 2012-12-27 10:14:15Z timgno $
 */
include __DIR__.'/header.php';
// Requests $_POST, $_GET, $_REQUEST
$op = Request::getCmd('op', 'list');
$start = Request::getInt('start', 0);
// Limit of pages
$limit = $helper->getConfig('adminpager');
// Get Requests
$fieldId = Request::getInt('field_id');
$fieldMid = Request::getInt('field_mid');
$fieldTid = Request::getInt('field_tid');
$fieldName = Request::getString('field_name', '');
// Get header template
$xoops->header('admin:tdmcreate/tdmcreate_fields.tpl');
//
$adminMenu->renderNavigation('fields.php');
//
switch ($op) {
    case 'list':
    default:
        $adminMenu->addTips(TDMCreateLocale::FIELD_TIPS);
        $adminMenu->addItemButton(TDMCreateLocale::A_ADD_TABLE, 'tables.php?op=new', 'add');
        $adminMenu->addItemButton(TDMCreateLocale::A_LIST_TABLES, 'tables.php', 'application-view-detail');
        $adminMenu->addItemButton(TDMCreateLocale::A_LIST_FIELDS, 'fields.php', 'application-view-detail');
        $adminMenu->renderTips();
        $adminMenu->renderButton();
        $xoops->theme()->addStylesheet('modules/tdmcreate/assets/css/styles.css');
        $xoops->theme()->addScript('modules/tdmcreate/assets/js/functions.js');
        $xoops->theme()->addScript('modules/tdmcreate/assets/js/sortable.js');
        $xoops->tpl()->assign('modPathIcon16', TDMC_ROOT_PATH.'/assets/icones/16');
        $numbRowsTables = $tablesHandler->getCountTables();
        if ($numbRowsTables == 0) {
            $xoops->redirect('tables.php?op=new', 2, TDMCreateLocale::E_NO_TABLES);
        }
        // Get modules list
        $tablesArray = $tablesHandler->getAllTablesByModuleId($tablesHandler->getVar('table_mid'), $start, $limit);
        $xoops->tpl()->assign('tables_count', $numbRowsTables);
        // Redirect if there aren't modules
        if ($numbRowsTables == 0) {
            $xoops->redirect('tables.php?op=new', 2, TDMCreateLocale::E_NO_TABLES);
        }
        // Assign Template variables
        if ($numbRowsTables > 0) {
            foreach (array_keys($tablesArray) as $t) {
                $table = $tablesArray[$t]->getValues();
                $numRowsFields = $fieldsHandler->getCountFields($fieldMid, $t);
                $fieldsArray = $fieldsHandler->getAllFieldsByTableId($fieldMid, $t);
                $xoops->tpl()->assign('fields_count', $numRowsFields);
                $fields = array();
                if ($numRowsFields > 0) {
                    $lid = 1;
                    foreach (array_keys($fieldsArray) as $f) {
                        $field = $fieldsArray[$f]->getValues();
                        $alid = array('lid' => $lid);
                        $fields[] = array_merge($field, $alid);
                        unset($field);
                        ++$lid;
                    }
                    unset($lid);
                }
                $table['fields'] = $fields;
                $xoops->tpl()->appendByRef('tables', $table);
                unset($table);
            }
            // Display Page Navigation
            if ($numbRowsTables > $limit) {
                $nav = new XoopsPageNav($numbRowsTables, $limit, $start, 'start');
                $xoops->tpl()->assign('pagenav', $nav->renderNav(4));
            }
        } else {
            $xoops->tpl()->assign('error_message', TDMCreateLocale::FIELD_ERROR_NOFIELDS);
        }
    break;

    case 'new':
        $adminMenu->addItemButton(TDMCreateLocale::A_LIST_FIELDS, 'fields.php', 'application-view-detail');
        $adminMenu->renderButton();

        $fieldsObj = $fieldsHandler->create();
        $form = $xoops->getModuleForm($fieldsObj, 'fields');
        $xoops->tpl()->assign('form', $form->render());
    break;

    case 'save':
        if (!$xoops->security()->check()) {
            $xoops->redirect('fields.php', 3, implode(',', $xoops->security()->getErrors()));
        }
        $fieldOrder = 0;
        //Form fields
        foreach ($_POST['field_id'] as $key => $value) {
            if (isset($value)) {
                $fieldsObj = &$fields->get($value);
            } else {
                $fieldsObj = &$fields->create();
            }
            $order = $fieldsObj->isNew() ? $fieldOrder++ : Request::getInt('field_order');
            // Set Data
            $fieldsObj->setVar('field_mid', $fieldMid);
            $fieldsObj->setVar('field_tid', $fieldTid);
            $fieldsObj->setVar('field_order', $order);
            $fieldsObj->setVar('field_name', $_POST['field_name'][$key]);
            $fieldsObj->setVar('field_type', $_POST['field_type'][$key]);
            $fieldsObj->setVar('field_value', $_POST['field_value'][$key]);
            $fieldsObj->setVar('field_attribute', $_POST['field_attribute'][$key]);
            $fieldsObj->setVar('field_null', $_POST['field_null'][$key]);
            $fieldsObj->setVar('field_default', $_POST['field_default'][$key]);
            $fieldsObj->setVar('field_key', $_POST['field_key'][$key]);
            $fieldsObj->setVar('field_element', $_POST['field_element'][$key]);
            $fieldsObj->setVar('field_parent', (1 == $_REQUEST['field_parent'][$key]) ? 1 : 0);
            $fieldsObj->setVar('field_inlist', (1 == $_REQUEST['field_inlist'][$key]) ? 1 : 0);
            $fieldsObj->setVar('field_inform', (1 == $_REQUEST['field_inform'][$key]) ? 1 : 0);
            $fieldsObj->setVar('field_admin', (1 == $_REQUEST['field_admin'][$key]) ? 1 : 0);
            $fieldsObj->setVar('field_user', (1 == $_REQUEST['field_user'][$key]) ? 1 : 0);
            $fieldsObj->setVar('field_block', (1 == $_REQUEST['field_block'][$key]) ? 1 : 0);
            $fieldsObj->setVar('field_main', ($key == $_REQUEST['field_main'] ? 1 : 0));
            $fieldsObj->setVar('field_search',  (1 == $_REQUEST['field_search'][$key]) ? 1 : 0);
            $fieldsObj->setVar('field_required', (1 == $_REQUEST['field_required'][$key]) ? 1 : 0);
            // Insert Data
            $fieldsHandler->insert($fieldsObj);
        }
        unset($fieldOrder);
        // Get table name from field table id
        $tables = &$tablesHandler->get($fieldTid);
        $tableName = $tables->getVar('table_name');
        // Set field elements
        if ($fieldsObj->isNew()) {
            // Fields Elements Handler
            $fieldelementsHandler = $helper->getFieldElementsHandler();
            $fieldelementObj = &$fieldelementsHandler->create();
            $fieldelementObj->setVar('fieldelement_mid', $fieldMid);
            $fieldelementObj->setVar('fieldelement_tid', $fieldTid);
            $fieldelementObj->setVar('fieldelement_name', 'Table : '.ucfirst($tableName));
            $fieldelementObj->setVar('fieldelement_value', 'XoopsFormTables-'.ucfirst($tableName));
            // Insert new field element id for table name
            if (!$fieldelementsHandler->insert($fieldelementObj)) {
                $GLOBALS['xoopsTpl']->assign('error', $fieldelementObj->getHtmlErrors().' Field element');
            }
            $xoops->redirect('fields.php', 2, sprintf(XoopsLocale::S_DATABASE_SAVED, $tableName));
        } else {
            // Needed code from table name by field_tid
            $xoops->redirect('fields.php', 2, sprintf(XoopsLocale::S_DATABASE_UPDATED, $tableName));
        }
        $xoops->error($fieldsObj->getHtmlErrors());
    break;

    case 'edit':
        $adminMenu->addItemButton(TDMCreateLocale::A_ADD_TABLE, 'tables.php?op=new', 'add');
        $adminMenu->addItemButton(TDMCreateLocale::A_LIST_TABLES, 'tables.php', 'application-view-detail');
        $adminMenu->addItemButton(TDMCreateLocale::A_LIST_FIELDS, 'fields.php', 'application-view-detail');
        $adminMenu->renderButton();

        $fieldsObj = $fieldsHandler->get($fieldTid);
        $form = $xoops->getModuleForm($fieldsObj, 'fields');
        $xoops->tpl()->assign('form', $form->render());
    break;

    case 'delete':
        if ($fieldId > 0) {
            $fieldsObj = $fieldsHandler->get($fieldId);
            if (isset($_POST['ok']) && $_POST['ok'] == 1) {
                if (!$xoops->security()->check()) {
                    $xoops->redirect('fields.php', 3, implode(',', $xoops->security()->getErrors()));
                }
                if ($fieldsHandler->delete($fieldsObj)) {
                    $xoops->redirect('fields.php', 2, sprintf(TDMCreateLocale::S_DELETED, TDMCreateLocale::TABLE));
                } else {
                    $xoops->error($fieldsObj->getHtmlErrors());
                }
            } else {
                $xoops->confirm(array('ok' => 1, 'id' => $fieldId, 'op' => 'delete'), 'fields.php', sprintf(TDMCreateLocale::QF_ARE_YOU_SURE_TO_DELETE, $fieldsObj->getVar('field_name')).'<br />');
            }
        } else {
            $xoops->redirect('fields.php', 1, TDMCreateLocale::E_DATABASE_ERROR);
        }
    break;
}
$xoops->footer();

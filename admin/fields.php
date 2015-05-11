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
 * tdmcreate module
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         tdmcreate
 * @since           2.6.0
 * @author          TDM Xoops (AKA Developers)
 * @version         $Id: fields.php 10665 2012-12-27 10:14:15Z timgno $
 */
include __DIR__ . '/header.php';

$fieldId = Request::getInt('field_id');
$fieldMid = Request::getInt('field_mid');
$fieldTid = Request::getInt('field_tid');	
$fieldNumb = Request::getInt('field_numb');
$fieldName = Request::getString('field_name', '');

// Get handler
$xoops->header('admin:tdmcreate/tdmcreate_fields.tpl');

$adminMenu->renderNavigation('fields.php');
switch ($op) 
{   
    case 'list': 
    default:               
	    $adminMenu->addItemButton(TDMCreateLocale::A_ADD_TABLE, 'tables.php?op=new', 'add');            
	    $adminMenu->renderButton(); 
        // Get modules list
        $criteria = new CriteriaCompo(new Criteria('table_mid', $fieldMid));
		$criteria->add(new Criteria('table_id', $fieldTid));
        $criteria->setSort('table_name');
        $criteria->setOrder('ASC'); 
        $criteria->setStart($start);
        $criteria->setLimit($limit);		
        $numRowsTables = $tablesHandler->getCount($criteria);
		$tablesArray = $tablesHandler->getAll($criteria);
		$xoops->tpl()->assign('tables_count', $numRowsTables);
		unset($criteria);
		// Redirect if there aren't modules
        if ( $numRowsTables == 0 ) {
            $xoops->redirect('tables.php?op=new', 2, TDMCreateLocale::E_NO_TABLES );
        }			                	
        // Assign Template variables
        $xoops->tpl()->assign('fields_list', true);
		$xoops->tpl()->assign('fields_count', $numRowsFields);		
        if ($numRowsTables > 0) {
            foreach (array_keys($tablesArray) as $i) {                
                $tables['id'] = $tablesArray[$i]->getVar('table_id');
				$tables['name'] = $tablesArray[$i]->getVar('table_name');				
				$module_name = $modules_Handler->get($tablesArray[$i]->getVar('table_mid'));
				$tables['mid'] = $module_name->getVar('mod_name');
				$tables['image'] = $tablesArray[$i]->getVar('table_image');                
				$tables['nbfields'] = $tablesArray[$i]->getVar('table_nbfields'); 
				$tables['blocks'] = $tablesArray[$i]->getVar('table_blocks');
				$tables['admin'] = $tablesArray[$i]->getVar('table_admin');                
				$tables['user'] = $tablesArray[$i]->getVar('table_user'); 
				$tables['submenu'] = $tablesArray[$i]->getVar('table_submenu');	
				$tables['search'] = $tablesArray[$i]->getVar('table_search');                
				$tables['comments'] = $tablesArray[$i]->getVar('table_comments'); 
				$tables['notifications'] = $tablesArray[$i]->getVar('table_notifications');	                
				$xoops->tpl()->append_by_ref('tables', $tables);
				unset($tables);				
            }
			$criteria = new CriteriaCompo();
			$criteria->add(new Criteria('field_tid', $fieldTid));
			$criteria->setSort('field_id');
			$criteria->setOrder('ASC');	
			$numRowsFields = $fieldsHandler->getCount($criteria);
			$fieldsArray = $fieldsHandler->getAll($criteria);		
			unset($criteria);
			if ($numRowsFields > 0) {
				foreach (array_keys($fieldsArray) as $i) {
					$field['id'] = $fieldsArray[$i]->getVar('field_id');
					$table_name = $tablesHandler->get($fieldsArray[$i]->getVar('field_tid'));
					$field['tid'] = $table_name->getVar('table_name');				
					$field['name'] = $fieldsArray[$i]->getVar('field_name');
					$field['type'] = $fieldsArray[$i]->getVar('field_type');                
					$field['value'] = $fieldsArray[$i]->getVar('field_value');  
					$field['blocks'] = $fieldsArray[$i]->getVar('field_blocks');
					$field['attribute'] = $fieldsArray[$i]->getVar('field_attribute');
					$field['default'] = $fieldsArray[$i]->getVar('field_default');
					$field['key'] = $fieldsArray[$i]->getVar('field_key');					
					$field['blocks'] = $fieldsArray[$i]->getVar('field_blocks');
					$field['search'] = $fieldsArray[$i]->getVar('field_search');                     
					$field['required'] = $fieldsArray[$i]->getVar('field_required');						
					$xoops->tpl()->append_by_ref('fields', $field);
					unset($field);
				}
			}
            // Display Page Navigation
			if ($numRowsTables > $limit) {
				$nav = new XoopsPageNav($numRowsTables, $limit, $start, 'start');
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
		foreach($_POST['field_id'] as $key => $value) 
		{				
			if(isset($value)){
				$fieldsObj =& $fieldsHandler->get($value);
			} else { 					
				$fieldsObj =& $fieldsHandler->create();										
			}
			
			$order = $fieldsObj->isNew() ? $fieldOrder++ : Request::getInt('field_order');
			// Set Data	
			$fieldsObj->setVar( 'field_mid', $fieldMid );
			$fieldsObj->setVar( 'field_tid', $fieldTid );								
			$fieldsObj->setVar( 'field_order', $order );
			$fieldsObj->setVar( 'field_name', $_POST['field_name'][$key]);
			$fieldsObj->setVar( 'field_type', $_POST['field_type'][$key]); 
			$fieldsObj->setVar( 'field_value', $_POST['field_value'][$key]);
			$fieldsObj->setVar( 'field_attribute', $_POST['field_attribute'][$key]);
			$fieldsObj->setVar( 'field_null', $_POST['field_null'][$key]); 
			$fieldsObj->setVar( 'field_default', $_POST['field_default'][$key]); 
			$fieldsObj->setVar( 'field_key', $_POST['field_key'][$key]);						
			$fieldsObj->setVar( 'field_element', $_POST['field_element'][$key]);               
			$fieldsObj->setVar( 'field_parent', (1 == $_REQUEST['field_parent'][$key]) ? 1 : 0);
			$fieldsObj->setVar( 'field_inlist', (1 == $_REQUEST['field_inlist'][$key]) ? 1 : 0);
			$fieldsObj->setVar( 'field_inform', (1 == $_REQUEST['field_inform'][$key]) ? 1 : 0);
			$fieldsObj->setVar( 'field_admin', (1 == $_REQUEST['field_admin'][$key]) ? 1 : 0);
			$fieldsObj->setVar( 'field_user', (1 == $_REQUEST['field_user'][$key]) ? 1 : 0); 
			$fieldsObj->setVar( 'field_block', (1 == $_REQUEST['field_block'][$key]) ? 1 : 0); 
			$fieldsObj->setVar( 'field_main', ($key == $_REQUEST['field_main'] ? 1 : 0)); 
			$fieldsObj->setVar( 'field_search',  (1 == $_REQUEST['field_search'][$key]) ? 1 : 0); 
			$fieldsObj->setVar( 'field_required', (1 == $_REQUEST['field_required'][$key]) ? 1 : 0);
			// Insert Data
			$tdmcreate->getHandler('fields')->insert($fieldsObj);
		}
		unset($fieldOrder);
		// Get table name from field table id
		$tables =& $tdmcreate->getHandler('tables')->get($fieldTid);
		$tableName = $tables->getVar('table_name');
		// Set field elements
		if ($fieldsObj->isNew()) {		    
			// Fields Elements Handler
			$fieldelementObj =& $tdmcreate->getHandler('fieldelements')->create();
			$fieldelementObj->setVar( 'fieldelement_mid', $fieldMid );
			$fieldelementObj->setVar( 'fieldelement_tid', $fieldTid );
			$fieldelementObj->setVar( 'fieldelement_name', 'Table : '.ucfirst($tableName) );
			$fieldelementObj->setVar( 'fieldelement_value', 'XoopsFormTables-'.ucfirst($tableName) );
			// Insert new field element id for table name
			if (!$tdmcreate->getHandler('fieldelements')->insert($fieldelementObj) ) {
				$GLOBALS['xoopsTpl']->assign('error', $fieldelementObj->getHtmlErrors() . ' Field element');
			}			
			redirect_header('fields.php', 2, sprintf(_AM_TDMCREATE_FIELDS_FORM_SAVED_OK, $tableName));					
		} else {
			// Needed code from table name by field_tid
			redirect_header('fields.php', 2, sprintf(_AM_TDMCREATE_FIELDS_FORM_UPDATED_OK, $tableName));
		}
		// Save data					
        if ($fieldsHandler->insert($fieldsObj)) {
            $xoops->redirect('fields.php', 2, TDMCreateLocale::FORMOK);
        }
		
        $xoops->error($fieldsObj->getHtmlErrors());
	break;		
	
	case 'edit':      
        $adminMenu->addItemButton(TDMCreateLocale::A_ADD_TABLE, 'tables.php?op=new', 'add');
		$adminMenu->addItemButton(TDMCreateLocale::A_LIST_TABLES, 'tables.php?op=list', 'add');
		$adminMenu->addItemButton(TDMCreateLocale::A_LIST_FIELDS, 'fields.php', 'application-view-detail');
        $adminMenu->renderButton();
		
		$fieldsObj = $fieldsHandler->get($fieldTid);		
		$form = $xoops->getModuleForm($fieldsObj, 'fields');
        $xoops->tpl()->assign('form', $form->render());
	break;	
}
$xoops->footer();
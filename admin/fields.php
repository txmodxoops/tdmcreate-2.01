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
 * @version         $Id: fields.php 10665 2012-12-27 10:14:15Z timgno $
 */
include dirname(__FILE__) . '/header.php';

$field_id = $system->cleanVars($_REQUEST, 'field_id', 0, 'int');
$field_mid = $system->cleanVars($_REQUEST, 'field_mid', 0, 'int');
$field_tid = $system->cleanVars($_REQUEST, 'field_tid', 0, 'int');	
$field_numb = $system->cleanVars($_REQUEST, 'field_numb', 0, 'int');
$field_name = $system->cleanVars($_REQUEST, 'field_name', 0, 'int');

// Get handler
$xoops->header('tdmcreate_fields.html');

$admin_menu->renderNavigation('fields.php');
switch ($op) 
{   
    case 'list': 
    default:               
	    $admin_menu->addItemButton(TDMCreateLocale::ADD_TABLE, 'tables.php?op=new', 'add');            
	    $admin_menu->renderButton(); 
        // Get modules list
        $criteria = new CriteriaCompo(new Criteria('table_mid', $field_mid));
		$criteria->add(new Criteria('table_id', $field_tid));
        $criteria->setSort('table_name');
        $criteria->setOrder('ASC'); 
        $criteria->setStart($start);
        $criteria->setLimit($limit);		
        $numrows_tables = $tables_Handler->getCount($criteria);
		$table_arr = $tables_Handler->getAll($criteria);
		$xoops->tpl()->assign('tables_count', $numrows_tables);
		unset($criteria);
		// Redirect if there aren't modules
       /* if ( $numrows_mods == 0 ) {
            $xoops->redirect('modules.php?op=new', 2, TDMCreateLocale::NOTMODULES );
        }*/  	
		$criteria = new CriteriaCompo();
	    $criteria->add(new Criteria('field_tid', $field_tid));
		$criteria->setSort('field_name');
		$criteria->setOrder('ASC');	
        $criteria->setStart($start);
        $criteria->setLimit($limit);
        $numrows_fields = $fields_Handler->getCount($criteria);
        $field_arr = $fields_Handler->getAll($criteria);		
		unset($criteria);	                	
        // Assign Template variables
        $xoops->tpl()->assign('fields_list', true);
		$xoops->tpl()->assign('fields_count', $numrows_fields);		
        if ($numrows_tables > 0) {
            foreach (array_keys($table_arr) as $i) {                
                $tables['id'] = $table_arr[$i]->getVar('table_id');
				$tables['name'] = $table_arr[$i]->getVar('table_name');				
				$module_name = $modules_Handler->get($table_arr[$i]->getVar('table_mid'));
				$tables['mid'] = $module_name->getVar('mod_name');
				$tables['image'] = $table_arr[$i]->getVar('table_image');                
				$tables['nbfields'] = $table_arr[$i]->getVar('table_nbfields'); 
				$tables['blocks'] = $table_arr[$i]->getVar('table_blocks');
				$tables['admin'] = $table_arr[$i]->getVar('table_admin');                
				$tables['user'] = $table_arr[$i]->getVar('table_user'); 
				$tables['submenu'] = $table_arr[$i]->getVar('table_submenu');	
				$tables['search'] = $table_arr[$i]->getVar('table_search');                
				$tables['comments'] = $table_arr[$i]->getVar('table_comments'); 
				$tables['notifications'] = $table_arr[$i]->getVar('table_notifications');	                
				$xoops->tpl()->append_by_ref('tables', $tables);
				unset($tables);				
            }
			if ($numrows_fields > 0) {
				foreach (array_keys($field_arr) as $i) {
					$field['id'] = $field_arr[$i]->getVar('field_id');
					$table_name = $tables_Handler->get($field_arr[$i]->getVar('field_tid'));
					$field['tid'] = $table_name->getVar('table_name');				
					$field['name'] = $field_arr[$i]->getVar('field_name');
					$field['type'] = $field_arr[$i]->getVar('field_type');                
					$field['value'] = $field_arr[$i]->getVar('field_value');  
					$field['blocks'] = $field_arr[$i]->getVar('field_blocks');
					$field['attribute'] = $field_arr[$i]->getVar('field_attribute');
					$field['default'] = $field_arr[$i]->getVar('field_default');
					$field['key'] = $field_arr[$i]->getVar('field_key');
					$field['auto_increment'] = $field_arr[$i]->getVar('field_auto_increment');   
					$field['blocks'] = $field_arr[$i]->getVar('field_blocks');
					$field['search'] = $field_arr[$i]->getVar('field_search');                     
					$field['required'] = $field_arr[$i]->getVar('field_required');						
					$xoops->tpl()->append_by_ref('fields', $field);
					unset($field);
				}
			}
            // Display Page Navigation
			if ($numrows_tables > $nb_pager) {
				$nav = new XoopsPageNav($numrows_tables, $nb_pager, $start, 'start');
				$xoops->tpl()->assign('pagenav', $nav->renderNav(4));
			}
        } else {
            $xoops->tpl()->assign('error_message', TDMCreateLocale::FIELD_ERROR_NOFIELDS);
        }				
    break;
	
    case 'new':     
        $admin_menu->addItemButton(TDMCreateLocale::FIELDS_LIST, 'fields.php', 'application-view-detail');
        $admin_menu->renderButton();		
		
		$obj = $fields_Handler->create();
		$form = $xoops->getModuleForm($obj, 'fields');
        $xoops->tpl()->assign('form', $form->render());
    break;	
	
	case 'save':
		if (!$xoops->security()->check()) {
			$xoops->redirect('fields.php', 3, implode(',', $xoops->security()->getErrors()));
		}		
        if ($field_id) {
            $obj = $fields_Handler->get($field_id);
        } else {
            $obj = $fields_Handler->create();
        }			
		//Form fields
		$obj->setVars(array('field_mid' => $field_mid, 'field_tid' => $field_tid, 'field_name' => $field_name, 
		                    'field_numb' => $field_numb, 'field_type' => $_POST['field_type'], 
							'field_value' => $_POST['field_value'], 'field_attribute' => $_POST['field_attribute'], 
							'field_null' => $_POST['field_null'], 'field_default' => $_POST['field_default'], 
							'field_key' => $_POST['field_key'],	'field_elements' => $_POST['field_elements'],
	                        'field_auto_increment' => (($_REQUEST['field_auto_increment'] == 1) ? '1' : '0'),
							'field_admin' => (($_REQUEST['field_admin'] == 1) ? '1' : '0'),
							'field_user' => (($_REQUEST['field_user'] == 1) ? '1' : '0'), 
							'field_blocks' => (($_REQUEST['field_blocks'] == 1) ? '1' : '0'), 
							'field_mainfield' => (($_REQUEST['field_mainfield'] == 1) ? '1' : '0'), 
							'field_search' =>  (($_REQUEST['field_search'] == 1) ? '1' : '0'), 
							'field_required' => (($_REQUEST['field_required'] == 1) ? '1' : '0')));	
		// Save data					
        if ($fields_Handler->insert($obj)) {
            $xoops->redirect('fields.php', 2, TDMCreateLocale::FORMOK);
        }
		
        $xoops->error($obj->getHtmlErrors());
	break;		
	
	case 'edit':      
        $admin_menu->addItemButton(TDMCreateLocale::ADD_TABLE, 'tables.php?op=new', 'add');	
		$admin_menu->addItemButton(TDMCreateLocale::FIELDS_LIST, 'fields.php', 'application-view-detail');
        $admin_menu->renderButton();
		
		$obj = $fields_Handler->get($field_tid);		
		$form = $xoops->getModuleForm($obj, 'fields');
        $xoops->tpl()->assign('form', $form->render());
	break;	
		
	case 'delete':			
        if ($field_id > 0) {
            $obj = $fields_Handler->get($field_id);			
			if (isset($_POST['ok']) && $_POST['ok'] == 1) {
                if (!$xoops->security()->check()) {
                    $xoops->redirect('fields.php', 3, implode(',', $xoops->security()->getErrors()));
                }
                if ($fields_Handler->delete($obj)) {
                    $xoops->redirect('fields.php', 2, sprintf(TDMCreateLocale::S_DELETED, TDMCreateLocale::TABLE));
                } else {
                    $xoops->error($obj->getHtmlErrors());
                }
            } else {			
				$xoops->confirm(array('ok' => 1, 'id' => $field_id, 'op' => 'delete'), 'fields.php', sprintf(TDMCreateLocale::QF_ARE_YOU_SURE_TO_DELETE, $obj->getVar('field_name')) . '<br />');
			}
		} else {
		    $xoops->redirect('fields.php', 1, TDMCreateLocale::E_DATABASE_ERROR);
		}
	break; 
}
$xoops->footer();
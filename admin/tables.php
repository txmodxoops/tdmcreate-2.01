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
 * @version         $Id: tables.php 10665 2012-12-27 10:14:15Z timgno $
 */
include dirname(__FILE__) . '/header.php';
// Preferences Limit
$nb_pager = $xoops->getModuleConfig('adminpager');
// Get Action type
$op = $system->cleanVars($_REQUEST, 'op', 'list', 'string');
$table_id = $system->cleanVars($_REQUEST, 'table_id', 0, 'int');
// Get start pager
$start = $system->cleanVars($_REQUEST, 'start', 0, 'int');
// heaser
$xoops->header('tdmcreate_tables.html');
// Get handler
/* @var $modules_handler TDMCreateModulesHandler */
$modules_Handler = $xoops->getModuleHandler('modules');
/* @var $tables_handler TDMCreateTablesHandler */
$tables_Handler = $xoops->getModuleHandler('tables');

$admin_menu->renderNavigation('tables.php');
switch ($op) 
{   
    case 'list': 
    default:               
	    $admin_menu->addItemButton(TDMCreateLocale::ADD_TABLE, 'tables.php?op=new', 'add');            
	    $admin_menu->renderButton();        
		// Get modules list
        $criteria = new CriteriaCompo();
        $criteria->setSort('mod_name');
        $criteria->setOrder('ASC'); 
        $criteria->setStart($start);
        $criteria->setLimit($nb_pager);		
        $numrows_mods = $modules_Handler->getCount($criteria);
		$mod_arr = $modules_Handler->getAll($criteria);
		$xoops->tpl()->assign('modules_count', $numrows_mods);
		$xoops->tpl()->assign('mimg_path', TDMC_MODULES_URL_IMG);
		unset($criteria);
		// Redirect if there aren't modules
       /* if ( $numrows_mods == 0 ) {
            $xoops->redirect('modules.php?op=new', 2, TDMCreateLocale::NOTMODULES );
        }*/ 			
                	
        // Assign Template variables
        $xoops->tpl()->assign('mods_count', $numrows_mods);		
        if ($numrows_mods > 0) {
            foreach (array_keys($mod_arr) as $i) {
                $mod['id'] = $mod_arr[$i]->getVar('mod_id');
                $mod['name'] = $mod_arr[$i]->getVar('mod_name'); 
				$mod['image'] = $mod_arr[$i]->getVar('mod_image');
                $mod['admin'] = $mod_arr[$i]->getVar('mod_admin');
                $mod['user'] = $mod_arr[$i]->getVar('mod_user'); 
				$mod['submenu'] = $mod_arr[$i]->getVar('mod_submenu');  
                $mod['search'] = $mod_arr[$i]->getVar('mod_search');
                $mod['comments'] = $mod_arr[$i]->getVar('mod_comments'); 
                $mod['notifications'] = $mod_arr[$i]->getVar('mod_notifications');            
				/*if (file_exists($timage = XOOPS_URL ."/uploads/tdmcreate/images/tables/".$table_image)) {
					$table['image'] =  $timage; 
				} elseif (file_exists($timage = XOOPS_URL ."/media/xoops/images/icons/32/".$table_image)) { 
					$table['image'] =  $timage;
				}*/	
				$criteria = new CriteriaCompo();
				$criteria->add(new Criteria('table_mid', $i));
				$criteria->setSort('table_name');
				$criteria->setOrder('ASC');	
				$criteria->setStart($start);
				$criteria->setLimit($nb_pager);
				$numrows_tables = $tables_Handler->getCount($criteria);
				$tables_arr = $tables_Handler->getAll($criteria);	
				$xoops->tpl()->assign('tables_count', $numrows_tables);	
				$xoops->tpl()->assign('timg_path', TDMC_TABLES_URL_IMG);
				unset($criteria);
                $tables = array();				
				if ($numrows_tables > 0) {
					foreach (array_keys($tables_arr) as $i) 
					{
						$table['id'] = $tables_arr[$i]->getVar('table_id');
						$table['name'] = $tables_arr[$i]->getVar('table_name');											
						$table['image'] = $tables_arr[$i]->getVar('table_image');					
						$table['nbfields'] = $tables_arr[$i]->getVar('table_nbfields'); 
						$table['blocks'] = $tables_arr[$i]->getVar('table_blocks');
						$table['admin'] = $tables_arr[$i]->getVar('table_admin');                
						$table['user'] = $tables_arr[$i]->getVar('table_user'); 
						$table['submenu'] = $tables_arr[$i]->getVar('table_submenu');	
						$table['search'] = $tables_arr[$i]->getVar('table_search');                
						$table['comments'] = $tables_arr[$i]->getVar('table_comments'); 
						$table['notifications'] = $tables_arr[$i]->getVar('table_notifications');						
						//$xoops->tpl()->append_by_ref('tables', $table);
						$tables[] = $table;
						unset($table);
					}
				}
				$mod['tables'] = $tables;	
				$xoops->tpl()->append_by_ref('modules', $mod);
                unset($mod);
			}
            // Display Page Navigation
			if ($numrows_mods > $nb_pager) {
				$nav = new XoopsPageNav($numrows_mods, $nb_pager, $start, 'start');
				$xoops->tpl()->assign('pagenav', $nav->renderNav(4));
			}
        } else {
            $xoops->tpl()->assign('error_message', TDMCreateLocale::TABLE_ERROR_NOMODULES);
        }		
    break;

    case 'new':        
        $admin_menu->addItemButton(TDMCreateLocale::TABLES_LIST, 'tables.php', 'application-view-detail');
        $admin_menu->renderButton();
        	
		$obj = $tables_Handler->create($table_id);
        $form = $xoops->getModuleForm($obj, 'tables');
        $xoops->tpl()->assign('form', $form->render());
    break;	
		
	case 'save':		
		if (!$xoops->security()->check()) {
			$xoops->redirect('tables.php', 3, implode(',', $xoops->security()->getErrors()));
		}
		
        if ($table_id > 0) {
            $obj = $tables_Handler->get($table_id);
        } else {
            $obj = $tables_Handler->create();
        }
		$table_mid = $request->asInt('table_mid', 0);
		$table_nbfields = $request->asInt('table_nbfields', 0);
		$table_fieldname = $request->asStr('table_fieldname', '');
		//Form tables		
		$obj->setVars(array('table_mid' => $table_mid, 'table_name' => $_POST['table_name'], 
		                    'table_nbfields' => $table_nbfields, 'table_fieldname' => $table_fieldname));
		//Form table_image
        $pathIcon32 = XOOPS_ROOT_PATH . '/media/xoops/images/icons/32';		
	    $uploaddir = ( is_dir($pathIcon32) && XoopsLoad::fileExists($pathIcon32) ) ? $pathIcon32 : TDMC_TABLES_PATH_IMG;	
        $uploader = new XoopsMediaUploader( $uploaddir, $xoops->getModuleConfig('mimetypes'), 
											   $xoops->getModuleConfig('maxuploadsize'), null, null);
		if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
		    $extension = preg_replace( '/^.+\.([^.]+)$/sU' , '\\1' , $_FILES['attachedfile']['name']);
            $img_name = $_GET['table_name'].'.'.$extension;
			$uploader->setPrefix($img_name);
			$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
			if (!$uploader->upload()) {
				$xoops->redirect('javascript:history.go(-1)',3, $uploader->getErrors());
			} else {
				$obj->setVar('table_image', $uploader->getSavedFileName());
			}
		} else {
			if ($_POST['tables_image'] == 'blank.gif') {
                $obj->setVar('table_image', $_POST['table_image']);
            } else {
                $obj->setVar('table_image', $_POST['tables_image']);
            }
		}		
		//Form tables
		$obj->setVars(array('table_blocks' => (($_REQUEST['table_blocks'] == 1) ? '1' : '0'), 
		                    'table_admin' => (($_REQUEST['table_admin'] == 1) ? '1' : '0'), 
		                    'table_user' => (($_REQUEST['table_user'] == 1) ? '1' : '0'), 
							'table_submenu' => (($_REQUEST['table_submenu'] == 1) ? '1' : '0'), 
							'table_search' => (($_REQUEST['table_search'] == 1) ? '1' : '0'), 
							'table_comments' => (($_REQUEST['table_comments'] == 1) ? '1' : '0'), 
							'table_notifications' => (($_REQUEST['table_notifications'] == 1) ? '1' : '0')));
				
        if( $tables_Handler->insert($obj) ) {	 
			if( $obj->isNew() ) {
				$tid = $xoops->db()->getInsertId();			
				$xoops->redirect('fields.php?op=new&amp;field_mid='.$mid.'&amp;field_tid='.$tid.'&amp;field_numb='.$table_nbfields.'&amp;field_name='.$table_fieldname, 3, XoopsLocale::S_DATA_INSERTED);			
			} else {
				$xoops->redirect('tables.php', 3, XoopsLocale::S_DATABASE_UPDATED);
			}
		}

        $xoops->error($obj->getHtmlErrors());
        $form = $xoops->getModuleForm($obj, 'tables');
        $xoops->tpl()->assign('form', $form->render());
	break;
	
	case 'edit':       
		$admin_menu->addItemButton(TDMCreateLocale::TABLE_ADD, 'tables.php?op=new', 'add');
		$admin_menu->addItemButton(TDMCreateLocale::TABLES_LIST, 'tables.php', 'application-view-detail');
        $admin_menu->renderButton();			

		$obj = $tables_Handler->get($table_id);
		$form = $xoops->getModuleForm($obj, 'tables');
		$xoops->tpl()->assign('form', $form->render());        
	break;	
		
	case 'delete':	        	
        if ($table_id > 0) {
            $obj = $tables_Handler->get($table_id);			
			if (isset($_POST['ok']) && $_POST['ok'] == 1) {
                if (!$xoops->security()->check()) {
                    $xoops->redirect('tables.php', 3, implode(',', $xoops->security()->getErrors()));
                }
                if ($tables_Handler->delete($obj)) {
                    $xoops->redirect('tables.php', 2, sprintf(TDMCreateLocale::S_DELETED, TDMCreateLocale::TABLE));
                } else {
                    $xoops->error($obj->getHtmlErrors());
                }
            } else {			
				$xoops->confirm(array('ok' => 1, 'id' => $table_id, 'op' => 'delete'), 'tables.php', sprintf(TDMCreateLocale::QF_ARE_YOU_SURE_TO_DELETE, $obj->getVar('table_name')) . '<br />');
			}
		} else {
		    $xoops->redirect('tables.php', 1, TDMCreateLocale::E_DATABASE_ERROR);
		}
	break; 	
}
$xoops->footer();
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
 * @version         $Id: tables.php 10665 2012-12-27 10:14:15Z timgno $
 */
include __DIR__ . '/header.php';
// Get $_POST, $_GET, $_REQUEST
$op = Request::getCmd('op', 'list');
$start = Request::getInt('start', 0);
// Parameters
$limit = $helper->getConfig('adminpager');
// Preferences Limit
$tableId = Request::getInt('table_id', 0);
// header
$xoops->header('admin:tdmcreate/tdmcreate_tables.tpl');
//
$adminMenu->renderNavigation('tables.php');
//
switch ($op) 
{   
    case 'list': 
    default:               
	    $adminMenu->addTips(TDMCreateLocale::TABLE_TIPS);
	    $adminMenu->addItemButton(TDMCreateLocale::A_ADD_TABLE, 'tables.php?op=new', 'add'); 
		$adminMenu->renderTips();
	    $adminMenu->renderButton();
		$xoops->theme()->addStylesheet('modules/tdmcreate/assets/css/styles.css');
		$xoops->theme()->addScript('modules/tdmcreate/assets/js/functions.js');
		$xoops->theme()->addScript('modules/tdmcreate/assets/js/sortable.js');
		// Get modules list
        $numbRowsMods = $modulesHandler->getCountModules();
		$modulesArray = $modulesHandler->getAllModules($start, $limit);
		$xoops->tpl()->assign('modules_count', $numbRowsMods);
		$xoops->tpl()->assign('modules_images_url', TDMC_UPLOAD_IMAGES_MODULES_URL);
		$xoops->tpl()->assign('modPathIcon16', TDMC_URL . '/assets/icons/16');
		// Redirect if there aren't modules
        if ( $numbRowsMods == 0 ) {
            $xoops->redirect('modules.php?op=new', 2, TDMCreateLocale::NOT_MODULES );
        }                	
        // Assign Template variables
        if ($numbRowsMods > 0) {            
			foreach (array_keys($modulesArray) as $m) {
                $module = $modulesArray[$m]->getValues();
				$numbRowsTables = $tablesHandler->getCountTables();
				$tablesArray    = $tablesHandler->getAllTablesByModuleId($m, $start, $limit);	
				$xoops->tpl()->assign('tables_count', $numbRowsTables);
				$xoops->tpl()->assign('tables_images_url', TDMC_UPLOAD_IMAGES_TABLES_URL);
                $tables = array();	
				
				if ($numbRowsTables > 0) {	
					$lid = 1;				
					foreach (array_keys($tablesArray) as $t)
					{
						$table = $tablesArray[$t]->getValues();
						$alid = array('lid' => $lid);
						$tables[] = array_merge($table, $alid);
						unset($table);
						++$lid;
					}
					unset($lid);
				}				
				$module['tables'] = $tables;	
				$xoops->tpl()->appendByRef('modules', $module);
                unset($module);
			}
            // Display Page Navigation
			if ($numbRowsMods > $limit) {
				$nav = new XoopsPageNav($numbRowsMods, $limit, $start, 'start');
				$xoops->tpl()->assign('pagenav', $nav->renderNav(4));
			}
        } else {
            $xoops->tpl()->assign('error_message', TDMCreateLocale::TABLE_ERROR_NOMODULES);
        }		
    break;

    case 'new':        
        $adminMenu->addItemButton(TDMCreateLocale::A_LIST_TABLES, 'tables.php', 'application-view-detail');
        $adminMenu->renderButton();
        	
		$tablesObj  = $tablesHandler->create($tableId);
        $form 		= $xoops->getModuleForm($tablesObj, 'tables');
        $xoops->tpl()->assign('form', $form->render());
    break;	
		
	case 'save':		
		if (!$xoops->security()->check()) {
			$xoops->redirect('tables.php', 3, implode(',', $xoops->security()->getErrors()));
		}
		//
        if (isset($tableId)) {
            $tablesObj =& $tables->get($tableId);			
        } else {            
			// Checking if table name exist in the same module
			$criteria = new CriteriaCompo();
			$criteria->add(new Criteria('table_mid', $tableMid));
			$tableNameSearch = $tables->getObjects($criteria);
			unset($criteria);
			//unset($criteria);
			foreach (array_keys($tableNameSearch) as $t) {
				if ($tableNameSearch[$t]->getVar('table_name') === $_POST['table_name']) {
					redirect_header('tables.php?op=new', 3, sprintf(_AM_TDMCREATE_ERROR_TABLE_NAME_EXIST, $_POST['table_name']));
				}
			}			
			$tablesObj =& $tables->create();
        }
        if ($tableId > 0) {
            $tablesObj = $tablesHandler->get($tableId);
        } else {
            $tablesObj = $tablesHandler->create();
        }
		$tableMid 	     = Request::getInt('table_mid', 0);
		$tableNumbFields = Request::getInt('table_nbfields', 0);
		$tableOrder 	 = Request::getInt('table_order', 0);
		$tableFieldname  = Request::getString('table_fieldname', '');
		//Form tables		
		$tablesObj->setVars(array('table_mid' 		  => $tableMid, 
								'table_name' 		  => Request::getString('table_name', ''),
								'table_solename' 	  => Request::getString('table_solename', ''), 
								'table_fieldname' 	  => $tableFieldname,
								'table_nbfields' 	  => $tableNumbFields,
								'table_order' 		  => $tableOrder,
								'table_autoincrement' => Request::getInt('table_autoincrement', 1),
								'table_category'      => Request::getInt('table_category', 0)));
		//Form table_image
	    $uploaddir  = ( is_dir(XOOPS_ICONS32_PATH) && XoopsLoad::fileExists(XOOPS_ICONS32_PATH) ) ? XOOPS_ICONS32_PATH : TDMC_UPLOAD_IMAGES_TABLES_PATH;	
        $uploader   = new XoopsMediaUploader( $uploaddir, $xoops->getModuleConfig('mimetypes'), 
											   $xoops->getModuleConfig('maxuploadsize'), null, null);
		if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
		    $extension = preg_replace( '/^.+\.([^.]+)$/sU' , '\\1' , $_FILES['tables_image']['name']);
            $imgName = $_POST['table_name'].'.'.$extension;
			$uploader->setPrefix($imgName);
			$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
			if (!$uploader->upload()) {
				$xoops->redirect('javascript:history.go(-1)',3, $uploader->getErrors());
			} else {
				$tablesObj->setVar('table_image', $uploader->getSavedFileName());
			}
		} else {
			if ($_POST['tables_image'] == 'blank.gif') {
                $tablesObj->setVar('table_image', $_POST['table_image']);
            } else {
                $tablesObj->setVar('table_image', $_POST['tables_image']);
            }
		}	
		$tableOption = Request::getArray('table_option', array());
		//Form tables
		$tablesObj->setVars(array(
								'table_blocks'    		=> in_array('blocks', $tableOption),
								'table_admin' 			=> in_array('admin', $tableOption), 
								'table_user' 			=> in_array('user', $tableOption), 
								'table_submenu' 		=> in_array('submenu', $tableOption),
								'table_submit' 			=> in_array('submit', $tableOption),
								'table_search' 			=> in_array('search', $tableOption), 
								'table_comments' 		=> in_array('comments', $tableOption), 
								'table_notifications' 	=> in_array('notifications', $tableOption), 
								'table_permissions' 	=> in_array('permissions', $tableOption), 
								'table_rate' 			=> in_array('rate', $tableOption), 
								'table_tag' 			=> in_array('tag', $tableOption),
								'table_broken' 			=> in_array('broken', $tableOption),
								'table_print' 			=> in_array('print', $tableOption), 
								'table_pdf' 			=> in_array('pdf', $tableOption), 
								'table_rss' 			=> in_array('rss', $tableOption), 
								'table_single' 			=> in_array('single', $tableOption), 
								'table_visit' 			=> in_array('visit', $tableOption)));
				
        if( $tablesHandler->insert($tablesObj) ) {	 
			if( $tablesObj->isNew() ) {
				$tid = $tablesHandler->getNewId();			
				$xoops->redirect('fields.php?op=new&amp;field_mid='.$tableMid.'&amp;field_tid='.$tid.'&amp;field_numb='.$tableNumbFields.'&amp;field_name='.$tableFieldname, 3, XoopsLocale::S_DATA_INSERTED);			
			} else {
				$xoops->redirect('tables.php', 3, XoopsLocale::S_DATABASE_UPDATED);
			}
		}

        $xoops->error($tablesObj->getHtmlErrors());
        $form = $xoops->getModuleForm($tablesObj, 'tables');
        $xoops->tpl()->assign('form', $form->render());
	break;
	
	case 'edit':       
		$adminMenu->addItemButton(TDMCreateLocale::A_ADD_TABLE, 'tables.php?op=new', 'add');
		$adminMenu->addItemButton(TDMCreateLocale::A_LIST_TABLES, 'tables.php', 'application-view-detail');
        $adminMenu->renderButton();			

		$tablesObj = $tablesHandler->get($tableId);
		$form = $xoops->getModuleForm($tablesObj, 'tables');
		$xoops->tpl()->assign('form', $form->render());        
	break;	
		
	case 'delete':	        	
        if ($tableId > 0) {
            $tablesObj = $tablesHandler->get($tableId);			
			if (isset($_POST['ok']) && $_POST['ok'] == 1) {
                if (!$xoops->security()->check()) {
                    $xoops->redirect('tables.php', 3, implode(',', $xoops->security()->getErrors()));
                }
                if ($tablesHandler->delete($tablesObj)) {
                    $xoops->redirect('tables.php', 2, sprintf(TDMCreateLocale::S_DELETED, TDMCreateLocale::TABLE));
                } else {
                    $xoops->error($tablesObj->getHtmlErrors());
                }
            } else {			
				$xoops->confirm(array('ok' => 1, 'id' => $tableId, 'op' => 'delete'), 'tables.php', sprintf(TDMCreateLocale::QF_ARE_YOU_SURE_TO_DELETE, $tablesObj->getVar('table_name')) . '<br />');
			}
		} else {
		    $xoops->redirect('tables.php', 1, TDMCreateLocale::E_DATABASE_ERROR);
		}
	break; 	
}

include __DIR__ . '/footer.php';
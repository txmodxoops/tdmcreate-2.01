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
 * @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license     GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @package	    tdmcreate
 * @since		2.6.0
 * @author 	    XOOPS Development Team
 * @version     $Id: modules.php 10665 2012-12-27 10:14:15Z timgno $
 */
include dirname(__FILE__) . '/header.php';
// Get Action type
$mod_id = $system->cleanVars($_REQUEST, 'mod_id', 0, 'int');
// Get handler
$xoops->header('tdmcreate_modules.html');
$admin_menu->renderNavigation('modules.php');
switch ($op) 
{   
    case 'list': 
    default:	
		$admin_menu->addItemButton(TDMCreateLocale::ADD_MODULE, 'modules.php?op=new', 'add');            
		$admin_menu->renderButton();
		// Get modules list
        $criteria = new CriteriaCompo();
        $criteria->setSort('mod_name');
        $criteria->setOrder('ASC'); 
        $criteria->setStart($start);
        $criteria->setLimit($limit);		
        $numrows_mods = $modules_Handler->getCount($criteria);
		$mod_arr = $modules_Handler->getAll($criteria);
        // Assign Template variables
        $xoops->tpl()->assign('modules_count', $numrows_mods);		
		unset($criteria);          
        if ($numrows_mods > 0) {
            foreach (array_keys($mod_arr) as $i) {
                $mod['id'] = $mod_arr[$i]->getVar('mod_id');
                $mod['name'] = $mod_arr[$i]->getVar('mod_name'); 
                $mod['version'] = $mod_arr[$i]->getVar('mod_version');
				$mod['image'] = $mod_arr[$i]->getVar('mod_image');
				$mod['release'] = $mod_arr[$i]->getVar('mod_release'); 
                $mod['status'] = $mod_arr[$i]->getVar('mod_status'); 
                $mod['admin'] = $mod_arr[$i]->getVar('mod_admin');
                $mod['user'] = $mod_arr[$i]->getVar('mod_user'); 
				$mod['submenu'] = $mod_arr[$i]->getVar('mod_submenu');  
                $mod['search'] = $mod_arr[$i]->getVar('mod_search');
                $mod['comments'] = $mod_arr[$i]->getVar('mod_comments'); 
                $mod['notifications'] = $mod_arr[$i]->getVar('mod_notifications');
				$xoops->tpl()->append_by_ref('modules', $mod);
                unset($mod);				
            }
            // Display Page Navigation
			if ($numrows_mods > $limit) {
				$nav = new XoopsPageNav($numrows_mods, $limit, $start, 'start');
				$xoops->tpl()->assign('pagenav', $nav->renderNav(4));
			}
        } else {
            $xoops->tpl()->assign('error_message', TDMCreateLocale::E_NO_MODULES);
        }		
    break;

    case 'new':        
        $admin_menu->addItemButton(TDMCreateLocale::MODULES_LIST, 'modules.php', 'application-view-detail');
        $admin_menu->renderButton();
        
		$obj = $modules_Handler->create();
        $form = $xoops->getModuleForm($obj, 'modules');
        $xoops->tpl()->assign('form', $form->render());
    break;	
	
	case 'save':
		if (!$xoops->security()->check()) {
			$xoops->redirect('modules.php', 3, implode(',', $xoops->security()->getErrors()));
		}
		$mod_id = $request->asInt('mod_id', 0);
        if ($mod_id > 0) {
            $obj = $modules_Handler->get($mod_id);
        } else {
            $obj = $modules_Handler->create();
        }        	
		//Form module save		
		$obj->setVars(array('mod_name' => $request->asStr('mod_name', ''), 
		                    'mod_isextension' => $request->asInt('mod_isextension', 0), 
		                    'mod_version' => $request->asStr('mod_version', ''), 
							'mod_description' => $request->asStr('mod_description', ''), 
							'mod_author' => $request->asStr('mod_author', ''), 
							'mod_author_mail' => $request->asStr('mod_author_mail', ''), 
							'mod_author_website_url' => $request->asStr('mod_author_website_url', ''), 
							'mod_author_website_name' => $request->asStr('mod_author_website_name', ''), 
							'mod_credits' => $request->asStr('mod_credits', ''), 
							'mod_license' => $request->asStr('mod_license', ''), 
							'mod_release_info' => $request->asStr('mod_release_info', ''), 
							'mod_release_file' => $request->asStr('mod_release_file', ''), 
							'mod_manual' => $request->asStr('mod_manual', ''), 
							'mod_manual_file' => $request->asStr('mod_manual_file', '')));		
		//Form module_image	       
        $uploader = new XoopsMediaUploader( TDMC_MODULES_PATH_IMG, $helper->getConfig('mimetypes'), 
											    $helper->getConfig('maxuploadsize'), null, null);
		if ($uploader->fetchMedia('xoops_upload_file')) {
		    $extension = preg_replace( "/^.+\.([^.]+)$/sU" , "\\1" , $_FILES['xoops_upload_file']['name']);
            $img_name = 'logo.'.$extension;
			$uploader->setPrefix($img_name);
			$uploader->fetchMedia('xoops_upload_file');
			if (!$uploader->upload()) {
				$xoops->redirect('javascript:history.go(-1)',3, $uploader->getErrors());
			} else {
				$obj->setVar('mod_image', $uploader->getSavedFileName());
			}
		} else {
			if ($_POST['modules_image'] == 'blank.gif') {
                $obj->setVar('mod_image', $_POST['mod_image']);
            } else {
                $obj->setVar('mod_image', $_POST['modules_image']);
            }
		}
		
        //Form module save		
		$obj->setVars(array('mod_demo_site_url' => $request->asStr('mod_demo_site_url', ''), 
		                    'mod_demo_site_name' => $request->asStr('mod_demo_site_name', ''), 
		                    'mod_support_url' => $request->asStr('mod_support_url', ''), 
							'mod_support_name' => $request->asStr('mod_support_name', ''), 
							'mod_website_url' => $request->asStr('mod_website_url', ''), 
							'mod_website_name' => $request->asStr('mod_website_name', ''), 
							'mod_release' => $request->asStr('mod_release', ''), 
							'mod_status' => $request->asStr('mod_status', ''),
							'mod_admin' => $request->asInt('mod_admin', 0), 
							'mod_user' => $request->asInt('mod_user', 0), 
		                    'mod_submenu' => $request->asInt('mod_submenu', 0), 
							'mod_search' => $request->asInt('mod_search', 0), 
							'mod_comments' => $request->asInt('mod_comments', 0), 
							'mod_notifications' => $request->asInt('mod_notifications', 0), 
							'mod_paypal' => $request->asStr('mod_paypal', ''), 
							'mod_subversion' => $request->asStr('mod_subversion', '')));
		// Insert Data		
        if ($modules_Handler->insert($obj)) {
            $xoops->redirect('modules.php', 2, XoopsLocale::S_DATA_INSERTED);
        }
        // Form Data
        $xoops->error($obj->getHtmlErrors());
        $form = $xoops->getModuleForm($obj, 'modules');
        $xoops->tpl()->assign('form', $form->render());
	break;
	
	case 'edit':	    
        $admin_menu->addItemButton(TDMCreateLocale::ADD_MODULE, 'modules.php?op=new', 'add');
		$admin_menu->addItemButton(TDMCreateLocale::MODULES_LIST, 'modules.php', 'application-view-detail');
        $admin_menu->renderButton();		
		$mod_id = $request->asInt('mod_id', 0);
		if ($mod_id > 0) {
			$obj = $modules_Handler->get($mod_id);
			$form = $helper->getForm($obj, 'modules');
			$xoops->tpl()->assign('form', $form->render());
		} else {
            $xoops->redirect('modules.php', 1, XoopsLocale::E_DATABASE_NOT_UPDATED);
        }
	break;
	
	case 'delete':	
        $mod_id = $request->asInt('mod_id', 0);	
		if ($mod_id > 0) {
			$obj = $modules_Handler->get($mod_id);			
			if (isset($_POST['ok']) && $_POST['ok'] == 1) {
				if (!$xoops->security()->check()) {
					$xoops->redirect('modules.php', 3, implode(',', $xoops->security()->getErrors()));
				}
				if ($modules_Handler->delete($obj)) {
					$xoops->redirect('modules.php', 2, sprintf(TDMCreateLocale::S_DELETED, TDMCreateLocale::MODULE));
				} else {
					$xoops->error($obj->getHtmlErrors());
				}
			} else {			
				$xoops->confirm(array('ok' => 1, 'mod_id' => $mod_id, 'op' => 'delete'), 'modules.php', sprintf(TDMCreateLocale::QF_ARE_YOU_SURE_TO_DELETE, $obj->getVar('mod_name')) . '<br />');
			}
        } else {
            $xoops->redirect('modules.php', 1, XoopsLocale::E_DATABASE_NOT_UPDATED);
        }		
	break;	
}
$xoops->footer();
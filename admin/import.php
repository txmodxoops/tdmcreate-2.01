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
 * @author          XOOPS Development Team
 * @version         $Id: import.php 10665 2012-12-27 10:14:15Z timgno $
 */
include dirname(__FILE__) . '/header.php';
// Preferences Limit
$nb_pager = $xoops->getModuleConfig('pager');
// Get Action type
$op = $system->cleanVars($_REQUEST, 'op', 'list', 'string');
$import_id = $system->cleanVars($_REQUEST, 'import_id', 0, 'int');
// Get limit pager
$limit = $system->cleanVars($_REQUEST, 'limit', 0, 'int');
// Get start pager
$start = $system->cleanVars($_REQUEST, 'start', 0, 'int');
// heaser
$xoops->header('tdmcreate_import.html');
// Get handler
/* @var $import_handler TDMCreateImportHandler */
$import_Handler = $xoops->getModuleHandler('import');

$admin_menu->renderNavigation('import.php');
switch ($op) 
{  	
	case 'list':     
	    $admin_menu->addItemButton(TDMCreateLocale::IMPORT_OLD_MODULE, 'import.php?op=new', 'add');            
		$admin_menu->renderButton();		
		// Get modules list
        $criteria = new CriteriaCompo();
        $criteria->setSort('import_name');
        $criteria->setOrder('ASC'); 
        $criteria->setStart($start);
        $criteria->setLimit($nb_pager);		
        $num_imports = $import_Handler->getCount($criteria);
		$import_arr = $import_Handler->getAll($criteria);
        // Assign Template variables
        $xoops->tpl()->assign('imports_count', $num_imports);		
		unset($criteria);          
        if ($num_imports > 0) {
            foreach (array_keys($import_arr) as $i) {
                $import['id'] = $import_arr[$i]->getVar('import_id');                 
                $import['mid'] = $import_arr[$i]->getVar('import_mid');
				$import['name'] = $import_arr[$i]->getVar('import_name');
				$import['nbtables'] = $import_arr[$i]->getVar('import_nbtables'); 
                $import['nbfields'] = $import_arr[$i]->getVar('import_nbfields');                
				$xoops->tpl()->append_by_ref('imports', $import);
                unset($import);				
            }
            // Display Page Navigation
			if ($numrows > $nb_pager) {
				$nav = new XoopsPageNav($numrows, $nb_pager, $start, 'start');
				$xoops->tpl()->assign('pagenav', $nav->renderNav(4));
			}
        } else {
            $xoops->tpl()->assign('error_message', TDMCreateLocale::IMPORT_ERROR_NOIMPORTS);
        }	
    break;
    	 
	case 'new':
        $admin_menu->addItemButton(TDMCreateLocale::IMPORTED_LIST, 'import.php', 'application-view-detail');
        $admin_menu->renderButton();

		$obj = $import_Handler->create();
        $form = $xoops->getModuleForm($obj, 'import');
        $xoops->tpl()->assign('form', $form->render());	
	break;
	
	case 'save':
        if (!$xoops->security()->check()) {
			$xoops->redirect('modules.php', 3, implode(',', $xoops->security()->getErrors()));
		}
		
        if ($import_id > 0) {
            $obj = $import_Handler->get($import_id);
			//Form imported edited save		
			$obj->setVar('import_mid', $_POST['import_mid']);
			$obj->setVar('import_name', $_POST['import_name']);
			$obj->setVar('import_nbtables', $_POST['import_nbtables']); 	
			$obj->setVar('import_tablename', $_POST['import_mid']);
			$obj->setVar('import_nbfields', $_POST['import_nbfields']);
			$obj->setVar('import_fieldelements', $_POST['import_fieldelements']);			
        } else {
            $obj = $import_Handler->create();
			//Form imported save			
			$obj->setVar('import_name', $_POST['import_name']);	
			$obj->setVar('import_mid', $_POST['import_mid']);
        	$files = $_FILES['importfile'];
			// If incoming data have been entered correctly
			if($_POST['upload'] == XoopsLocale::A_SUBMIT && isset($files['tmp_name']) && (substr($files['name'], -4) == '.sql'))
			{	
				// File recovery
				$dir = TDMC_UPLOAD_PATH_FILES; 
				$file = $_FILES['importfile'];
				$tmp_name = $file['tmp_name'];
				// Copy files to the server
				if (is_uploaded_file($tmp_name)) {				
					readfile($tmp_name);
					// The directory where you saved the file
					if ($file['error'] == UPLOAD_ERR_OK) {					
						$name = $file['name'];
						move_uploaded_file($tmp_name, $dir.'/'.$name);
					}
				} else {
					$xoops->redirect('import.php', 3, sprintf(TDMCreateLocale::E_FILE_NOT_UPLOADING, $file['tmp_name']));
				}           
					 
				// Copies data in the db         
				$filename = $dir.'/'.$name;			
				// File size
				$filesize = $files['size'];			
				// Check that the file was inserted and that there is
				if ( ($handle = fopen($filename, 'r') ) !== false) 
				{			    							
					// File reading until at the end				
					while ( !feof( $handle ))
					{ 	
						$buffer = fgets($handle, filesize($filename));			    				
						if(strlen($buffer) > 1)
						{ 						
							// search all comments
							$search = array ( '/\/\*.*(\n)*.*(\*\/)?/', '/\s*--.*\n/', '/\s*#.*\n/' );  
							// and replace with null
							$replace = array ( "\n" );
							$buffer = preg_replace($search, $replace, $buffer);							
							$buffer = str_replace('`', '', $buffer);
                            $buffer = str_replace(',', '', $buffer);							
							
							preg_match_all('/((\s)*(CREATE TABLE)(\s)+(.*)(\s)+(\())/', $buffer, $tablematch); // table name ... (match)
							if(count($tablematch[0]) > 0)
								array_push( $res_table, $tablematch[5][0] );
							/*preg_match_all('/((\()(\s)+([a-z_]+)(\s)*(.*)(\())/', $buffer, $fieldsmatch); // fields ... (match)
                            if(count($fieldsmatch[0]) > 0)
								array_push( $res_fields, $fieldsmatch[4][0] );	*/
                            /*preg_match_all('/((\()(\s)+([a-z_]+)(\s)*(.*)(\())/', $buffer, $typematch); // type ... (match)
                            if(count($typematch[0]) > 0)
								array_push( $res_keys, $typematch[6][0] );	*/
                            /*preg_match_all('/(\s)(\((.*)\))/', $buffer, $typevmatch); // type value ... (match)
                            if(count($typevmatch[0]) > 0)
								array_push( $res_keys, $typevmatch[4][0] );	*/
                            /*preg_match_all('/(\s)(\((.*)\))/', $buffer, $unsmatch); // unsigned ... (match)
                            if(count($unsmatch[0]) > 0)
								array_push( $res_unsigned, $unsmatch[4][0] );	*/
                            /*preg_match_all('/(\s)(\((.*)\))/', $buffer, $nullmatch); // NOT NULL ... (match)
                            if(count($nullmatch[0]) > 0)
								array_push( $res_null, $nullmatch[4][0] ); */
                            /*preg_match_all('/(\s)(\((.*)\))/', $buffer, $defaultmatch); // default ... (match)
                            if(count($defaultmatch[0]) > 0)
								array_push( $res_keys, $defaultmatch[4][0] );	*/
                            /*preg_match_all('/(\s)(\((.*)\))/', $buffer, $defaultvmatch); // default value ... (match)
                            if(count($defaultvmatch[0]) > 0)
								array_push( $res_keys, $defaultvmatch[4][0] ); */								
						}  else { 
							$xoops->redirect('import.php', 3, sprintf(TDMCreateLocale::E_SQL_FILE_DATA_NOT_MATCH, $buffer));
						} 				 
					}	
					
					// Insert query 
					if(strlen($res_table[0]) > 0) 
					{			
                        $t = 0;                         						
						foreach(array_keys($res_table) as $table) 
						{	
						    $obj->setVar('import_tablename', $res_table[$table]); //$_POST['import_tablename']	
							$obj->setVar('import_nbtables', $t); $t++;	//$_POST['import_nbtables']	
                            if(strlen($res_table[0]) > 0) 
							{	
							    $f = 0;						
								foreach(array_keys($res_fields) as $field)
								{															
									$obj->setVar('import_nbfields', $f); $f++; // $_POST['import_nbfields']
									$obj->setVar('import_fieldelements', $_POST['import_fieldelements']);									
								}
								unset($f);	
                            }								
						}	
                        unset($t);						
					}				
				} else {				
					$xoops->redirect('import.php', 3, TDMCreateLocale::E_FILE_NOT_OPEN_READING);
				}
				$xoops->redirect('import.php', 3, TDMCreateLocale::S_DATA_ENTERED);
				fclose($handle);
			} else {
				$xoops->redirect('import.php', 3, TDMCreateLocale::E_DATABASE_SQL_FILE_NOT_IMPORTED);
			}		
		}
		
		if ($import_Handler->insert($obj)) {
            $xoops->redirect('import.php', 3, TDMCreateLocale::FORM_OK);
        }		

        $xoops->error($obj->getHtmlErrors());
        $form = $xoops->getModuleForm($obj, 'import');
        $xoops->tpl()->assign('form', $form->render());
	break;
	
	case 'edit':
        $admin_menu->addItemButton(TDMCreateLocale::IMPORT_OLD_MODULE, 'import.php?op=import', 'add');   
		$admin_menu->addItemButton(TDMCreateLocale::IMPORTED_LIST, 'import.php', 'application-view-detail');
        $admin_menu->renderButton();		
		
		$obj = $import_Handler->get($import_id);
		$form = $xoops->getModuleForm($obj, 'import');
		$xoops->tpl()->assign('form', $form->render());        
	break;	
	
	case 'delete': 
        if ($import_id > 0) {
            $obj = $import_Handler->get($import_id);			
			if (isset($_POST['ok']) && $_POST['ok'] == 1) {
                if (!$xoops->security()->check()) {
                    $xoops->redirect('import.php', 3, implode(',', $xoops->security()->getErrors()));
                }
                if ($import_Handler->delete($obj)) {
                    $xoops->redirect('import.php', 2, sprintf(TDMCreateLocale::S_DELETED, TDMCreateLocale::IMPORT));
                } else {
                    $xoops->error($obj->getHtmlErrors());
                }
            } else {			
				$xoops->confirm(array('ok' => 1, 'id' => $import_id, 'op' => 'delete'), 'import.php', sprintf(TDMCreateLocale::QF_ARE_YOU_SURE_TO_DELETE, $obj->getVar('import_name')) . '<br />');
			}
		} else {
		    $xoops->redirect('import.php', 1, TDMCreateLocale::E_DATABASE_ERROR);
		}	
    break;
}
$xoops->footer();
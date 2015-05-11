<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/
use Xoops\Core\Database\Connection;
/**
 * tdmcreate module
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         tdmcreate
 * @since           2.6.0
 * @author          Timgno <txmodxoops@gmail.com>
 * @version         $Id: imports.php 10665 2012-12-27 10:14:15Z timgno $
 */
/**
 * Class TDMCreateImports
 */
class TDMCreateImports extends XoopsObject
{ 
    /*
	 *  @public regexp $search
	 */
	public $search = array ( '/\/\*.*(\n)*.*(\*\/)?/', '/\s*--.*\n/', '/\s*#.*\n/' );
	
	/*
	 *  @public regexp $replace
	 */
	public $replace = array ( "\n" );
	
	/*
	 *  @public regexp
	 */
	public $regexp = '/((\s)*(CREATE TABLE)(\s)*([a-z_]+)(\s)*(\()(\s)*([a-z_]+)(\s)*([a-z]+)(\()([0-9]{1,4})(\))(\s)*([a-z]+)(\s)*(NOT NULL)(\s)*([a-z_]+)(\s)*(\w+))/';
	
	/**
     * Constructor
     */
	public function __construct()
	{		
		$this->initVar('import_id',XOBJ_DTYPE_INT);
		$this->initVar('import_name',XOBJ_DTYPE_TXTBOX);
		$this->initVar('import_mid',XOBJ_DTYPE_INT);
        $this->initVar('import_nbtables',XOBJ_DTYPE_INT);
        $this->initVar('import_tablename',XOBJ_DTYPE_TXTBOX);
        $this->initVar('import_nbfields',XOBJ_DTYPE_INT);
        $this->initVar('import_fieldelements',XOBJ_DTYPE_TXTBOX);
	}
	
	public function getValues($keys = null, $format = null, $maxDepth = null)
    {
        $ret 					= parent::getValues($keys, $format, $maxDepth);
        $ret['id'] 				= $this->getVar('import_id');
		$ret['name']	 		= $this->getVar('import_name');
		$ret['mid'] 			= $this->getVar('import_mid');
        $ret['nbtables'] 		= number_format($this->getVar('import_nbtables'), 1);
        $ret['tablename'] 		= $this->getVar('import_tablename');
		$ret['nbfields'] 		= number_format($this->getVar('import_nbfields'), 1);
		$ret['fieldelements'] 	= $this->getVar('import_fieldelements');
        return $ret;
    }
	
	public function toArray()
    {
        $ret = parent::getValues();
        unset($ret['dohtml']);
        return $ret;
    }
	
	/**
	 * Perform a global regular expression
	 *
     * @param string $regex
	 * @param string $text
	 * @param array $matches
	 * @param integer $_1
	 * @param integer $_2
	 * @return array
     */
	public function getWordMatched($regex, $text, $matches, $_1, $_2)
	{
        preg_match_all($regex, $text, $matches);
		if(count($matches[0]) > 0) {
			$result[] = $matches[$_1][$_2];
        }			
		return $result;
	}
	
	/**
	 * Performs a search and replace with regular expressions
	 *
     * @param mixed $search	
	 * @param mixed $replace
	 * @param mixed $text
	 * @return mixed
     */
	public function getWordsReplace($search, $replace, $text)
	{	    
        $result = preg_replace($search, $replace, $text);
		return $result;
	}
	
	/**
	 * Replaces all occurrences of the search string with the replacement string
	 *
     * @param mixed $search	
	 * @param mixed $replace
	 * @param mixed $text
	 * @param string $char
	 * @return mixed
     */
	public function getStrReplace($search, $replace, $text, $char = '')
	{	
        $pos = strpos($text, $char);
        $res = str_replace($search, $replace, $text);
		return $res;
	}
}
/**
 * Class TDMCreateImportsHandler
 */
class TDMCreateImportsHandler extends XoopsPersistableObjectHandler
{
    /**
     * @param null|Connection $db
     */
	public function __construct(Connection $db = null)
    {
        parent::__construct($db, 'tdmcreate_imports', 'tdmcreateimports', 'import_id', 'import_name');
    }
	
	public function getAllImports($start = 0, $limit = 0, $sort = 'import_id ASC, import_name', $order = 'ASC')
    {
        $criteria = new CriteriaCompo();
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setStart($start);
        $criteria->setLimit($limit);
        return parent::getAll($criteria);
    }

    public function getCountImports($start = 0, $limit = 0, $sort = 'import_id ASC, import_name', $order = 'ASC')
    {
        $criteria = new CriteriaCompo();
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setStart($start);
        $criteria->setLimit($limit);
        return parent::getCount($criteria);
    }
}

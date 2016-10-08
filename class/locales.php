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
use Xoops\Core\Kernel\XoopsObject;
use Xoops\Core\Kernel\XoopsPersistableObjectHandler;
/**
 * tdmcreate module.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 *
 * @since           2.6.0
 *
 * @author          Timgno <txmodxoops@gmail.com>
 *
 * @version         $Id: locales.php 13058 2015-05-06 14:56:29Z txmodxoops $
 */
/**
 * Class TDMCreateLocale.
 */
class TDMCreateLocales extends XoopsObject
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->initVar('loc_id', XOBJ_DTYPE_INT);
        $this->initVar('loc_mid', XOBJ_DTYPE_INT);
        $this->initVar('loc_file', XOBJ_DTYPE_TXTBOX);
        $this->initVar('loc_define', XOBJ_DTYPE_TXTBOX);
        $this->initVar('loc_description', XOBJ_DTYPE_TXTBOX);
    }

    public function getValues($keys = null, $format = null, $maxDepth = null)
    {
        $ret = $this->getValues($keys, $format, $maxDepth);
        $ret['mid'] = $this->getVar('loc_mid');
        $ret['file'] = $this->getVar('loc_file');
        $ret['define'] = $this->getVar('loc_define');
        $ret['description'] = $this->getVar('loc_description');

        return $ret;
    }

    public function toArray()
    {
        $ret = $this->getValues();
        unset($ret['dohtml']);

        return $ret;
    }
}
/**
 * Class TDMCreateLocaleHandler.
 */
class TDMCreateLocalesHandler extends XoopsPersistableObjectHandler
{
    /**
     * @param null|Connection $db
     */
    public function __construct(Connection $db = null)
    {
        parent::__construct($db, 'tdmcreate_locales', 'tdmcreatelocales', 'loc_id', 'loc_mid');
    }

    public function getAllLocales($start = 0, $limit = 0, $sort = 'loc_id ASC, loc_mid', $order = 'ASC')
    {
        $criteria = new CriteriaCompo();
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setStart($start);
        $criteria->setLimit($limit);

        return parent::getAll($criteria);
    }

    public function getCountLocales($start = 0, $limit = 0, $sort = 'loc_id ASC, loc_mid', $order = 'ASC')
    {
        $criteria = new CriteriaCompo();
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setStart($start);
        $criteria->setLimit($limit);

        return parent::getCount($criteria);
    }
}

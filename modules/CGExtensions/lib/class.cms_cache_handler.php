<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: CGExtensions (c) 2008-2014 by Robert Campbell
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to provide useful functions
#  and commonly used gui capabilities to other modules.
#
#-------------------------------------------------------------------------
# CMSMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
# Visit the CMSMS Homepage at: http://www.cmsmadesimple.org
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# However, as a special exception to the GPL, this software is distributed
# as an addon module to CMS Made Simple.  You may not use this software
# in any Non GPL version of CMS Made simple, or in any version of CMS
# Made simple that does not indicate clearly and obviously in its admin
# section that the site was built with CMS Made simple.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------
#END_LICENSE

/**
 * This file contains classes designed to make a convenient way
 * for CGExtensions derived modules to do caching.
 *
 * @package CGExtensions
 * @category Utilities
 * @author  calguy1000 <calguy1000@cmsmadesimple.org>
 * @copyright Copyright 2010 by Robert Campbell
 */

/**
 * This class provides static methods for setting up an app wide cache handler.
 * to allow caching data for a limited amount of time.
 *
 * @package CGExtensions
 */
class cms_cache_handler
{
    const TYPE_ANY = 0;
    const TYPE_PAGE = 1;
    const TYPE_CONTENT = 2;
    const TYPE_MODULE = 3;
    const TYPE_TEMPLATE = 4;
    const TYPE_STYLESHEET = 5;

    /**
     * @ignore
     */
    static private $_instance;

    /**
     * @ignore
     */
    private $_driver;

    /**
     * @ignore
     */
    private function __construct() {}

    /**
     * @ignore
     */
    private function __clone() {}

    /**
     * Get the global instance of the cms_cache_handler object
     */
    final public static function get_instance()
    {
        if( !is_object(self::$_instance) ) self::$_instance = new cms_cache_handler;
        return self::$_instance;
    }

    /**
     * Set the cache driver into this object.
     *
     * @param cms_cache_driver $driver
     */
    final public function set_driver(cms_cache_driver& $driver)
    {
        $this->_driver = $driver;
    }

    /**
     * Return the cache driver for this object
     *
     * @return cms_cache_driver
     */
    final public function get_driver()
    {
        return $this->_driver;
    }

    /**
     * A wrapper to clear the cache (for a specified cache group) independent of the driver.
     * the cache driver may have a default group.
     *
     * @param string $group
     */
    final public function clear($group = '')
    {
        if( !self::can_cache() ) return FALSE;

        if( is_object($this->_driver) ) return $this->_driver->clear();
        return FALSE;
    }

    /**
     * A wrapper to retrieve a cached driver independent of the driver.
     * the cache driver may have a default group.
     *
     * @param string $key the cache key.
     * @param string $group
     */
    final public function get($key,$group = '')
    {
        if( !$this->can_cache() ) return FALSE;

        if( is_object($this->_driver) ) {
            return $this->_driver->get($key,$group);
        }
        return FALSE;
    }

    /**
     * A wrapper method to test if an item exists in the cache. Independent of the driver.
     * the cache driver may have a default group.
     *
     * @param string $key the cache key.
     * @param string $group
     */
    final public function exists($key,$group = '')
    {
        if( !self::can_cache() ) return FALSE;
        if( is_object($this->_driver) ) {
            return $this->_driver->exists($key,$group);
        }
        return FALSE;
    }

    /**
     * A wrapper method to remove an item from the cache. Independent of the driver.
     * the cache driver may have a default group.
     *
     * @param string $key the cache key.
     * @param string $group
     */
    final public function erase($key,$group = '')
    {
        if( !self::can_cache() ) return FALSE;
        if( is_object($this->_driver) ) {
            return $this->_driver->erase($key,$group);
        }
        return FALSE;
    }

    /**
     * A wrapper method to store data into the cache. Independent of the driver.
     * the cache driver may have a default group.
     *
     * @param string $key the cache key.
     * @param string $value The data to store.
     * @param string $group
     */
    final public function set($key,$value,$group = '')
    {
        if( !self::can_cache() ) return FALSE;
        if( is_object($this->_driver) ) {
            return $this->_driver->set($key,$value,$group);
        }
        return FALSE;
    }

    /**
     * This method tests if an item can be stored in the cache for a request.
     * This is because at certain times (i.e: during module installation, or in a stylesheet request)
     * it may be inappropriate or unable to store data as the cache would be invalidated
     * by a higher level function.
     *
     * @return bool
     */
    final public static function can_cache()
    {
        global $CMS_ADMIN_PAGE;
        global $CMS_INSTALL_PAGE;
        global $CMS_MODULE_PAGE;
        global $CMS_STYLESHEET;

        if( isset($CMS_INSTALL_PAGE) ) return FALSE;
        if( isset($CMS_ADMIN_PAGE) ) return FALSE;
        if( isset($_SERVER['REQUEST_METHOD']) && strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' ) return FALSE;

        $config = cms_config::get_instance();
        if( isset($config['debug']) && $config['debug'] == true ) return FALSE;

        $uid = get_userid(false);
        if( $uid ) return FALSE; // caching disabled for logged in administrators

        return TRuE;
    }

} // end of class

?>
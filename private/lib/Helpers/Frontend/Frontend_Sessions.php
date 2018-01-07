<?php
/**
 * Cim - A simple invoice manager
 *
 * @author      Sem Schilder <sem@tropical.email>
 * @copyright   (c) Sem Schilder
 * @link        https://github.com/xvilo/customer-invoice-manager
 */

class Frontend_Sessions
{
    private static $_instance = null;
    private $_predisInstance;

    public function __construct()
    {
        $this->_predisInstance = External_Object_Predis::get();
    }

    public static function get()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * @throws Exception;
     * @return array|bool
     */
    public function getCustomer()
    {
        if (!isset($_COOKIE['cimu'])) {
            return false;
        } else {
            //TODO (@xvilo): Fix session storage from Redis
            Util::todo('xvilo', 'Fix session storage from Redis');
            return ['data here'];
        }
    }
}

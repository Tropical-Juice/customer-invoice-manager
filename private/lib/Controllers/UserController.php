<?php
/**
 * Cim - A simple invoice manager
 *
 * @author      Sem Schilder <sem@tropical.email>
 * @copyright   (c) Sem Schilder
 * @link        https://github.com/xvilo/customer-invoice-manager
 */

/**
 * Class Routes
 */
class UserController
{
    /**
     * @var UserController
     */
    private static $_instance = null;

    /**
     * Checks if given login data is valid
     *
     * @param $username
     * @param $password
     */
    public function checkLogin($username, $password)
    {
        return false;
    }

    /**
     * Returns object of class
     *
     * @return UserController
     * @throws Exception
     */
    public static function get()
    {
        // Check if controller has been initialised
        if (self::$_instance === null) {
            self::$_instance = new UserController();
        }

        // Check if $_instance is of right type, then return.
        if (self::$_instance instanceof UserController) {
            return self::$_instance;
        } else {
            // This should never happen.
            throw new Exception('User Controller not set or wrong not of type UserController?');
        }
    }
}

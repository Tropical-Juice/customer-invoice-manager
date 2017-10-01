<?php
/**
 * Cim - A simple invoice manager
 *
 * @author      Sem Schilder <sem@tropical.email>
 * @copyright   (c) Sem Schilder
 * @link        https://github.com/xvilo/customer-invoice-manager
 */

/**
 * Class Cim_Frontend_Page_ErrorPage
 */
class Cim_Frontend_Service_Login extends Cim_Frontend_Service
{
    public function __construct()
    {
        // @TODO (@sem): Set login page data in session storage. E.g. current URL for auto redirection.
        Util::todo('xvilo', 'create login from database and redirect.');
        return true;
    }
}

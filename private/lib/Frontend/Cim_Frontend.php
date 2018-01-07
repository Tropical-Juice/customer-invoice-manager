<?php
/**
 * Cim - A simple invoice manager
 *
 * @author      Sem Schilder <sem@tropical.email>
 * @copyright   (c) Sem Schilder
 * @link        https://github.com/xvilo/customer-invoice-manager
 */

/**
 * Class Cim_Frontend
 */
class Cim_Frontend
{
    protected $post           = array();
    protected $cookies        = array();
    protected $_requiresLogin = false;

    /**
     * Cim_Frontend constructor.
     */
    public function __construct()
    {
        if ($this->shouldLogin() !== false) {
            $this->setLoginPageData();
            header('Location: '.  Settings::get('host') . Settings::get('domain') .'/login');
            exit();
        }

        $this->cookies = is_array($_COOKIE) ? $_COOKIE : array(); //COOKIES
        $this->post = is_array($_POST) ? $_POST : array(); //POST

        return true;
    }

    /**
     * Checks whether we need to login
     * @return bool|string false if no need to login, the login page class otherwise
     */
    final protected function shouldLogin()
    {
        return $this->_requiresLogin && is_null(Frontend_Sessions::get()->getCustomer()['login']) ? true : false;
    }

    final private function setLoginPageData()
    {
        // @TODO (@sem): Set login page data in session storage. E.g. current URL for auto redirection.
        return true;
    }

    /**
     * Page data. Array of data used in twig.
     *
     * @return array
     */
    protected function pageData()
    {
        return [
            'noPageDataGiven' => true,
        ];
    }
}

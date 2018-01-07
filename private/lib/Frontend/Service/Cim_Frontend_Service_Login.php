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
    protected function pageData()
    {
        if (!$username = util::arrayGet($this->post, 'username', false)) {
            throw new UserException('You need to enter a username');
        }

        if (!$password = util::arrayGet($this->post, 'password', false)) {
            throw new UserException('You need to enter a password');
        }

        $userController = UserController::get();

        if ($userId = $userController->checkLogin($username, $password)) {
            $userController->setLoginSession($userId);

            return ['redirect' => '/app'];
        } else {
            throw new UserException('Wrong credentials');
        }
    }
}

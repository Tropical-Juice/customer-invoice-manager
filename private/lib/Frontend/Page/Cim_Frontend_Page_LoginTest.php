<?php
/**
 * Cim - A simple invoice manager
 *
 * @author      Sem Schilder <sem@tropical.email>
 * @copyright   (c) Sem Schilder
 * @link        https://github.com/xvilo/customer-invoice-manager
 */

/**
 * Class Cim_Frontend_Page_LoginTest
 */
class Cim_Frontend_Page_LoginTest extends Cim_Frontend_Page
{
    protected $_requiresLogin = true;

    /**
     * Page data. Array of data used in twig.
     *
     * @return array
     */
    public function pageData()
    {
        return [];
    }
}

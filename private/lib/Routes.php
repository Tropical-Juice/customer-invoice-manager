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
class Routes
{
    /**
     * @var \Klein\Route
     */
    private $klein = null;

    /**
     * @var array
     */
    private $routeData = [];

    /**
     * Routes constructor.
     * @param $kleinInstance
     */
    public function __construct($kleinInstance)
    {
        $this->klein = $kleinInstance;
        $this->generateRouteData();
    }

    /**
     * Routes kan be added here. Routes are processed with Klein.php.
     * This function processes all routes and returns correct data.
     *
     * @return array
     */
    private function generateRouteData()
    {
        /**
         * Entry/Homepage Route
         */
        $this->klein->respond('GET', '/', function () {
            $this->routeData = $this->buildReturnData('Cim_Frontend_Page_Entry');
        });

        /**
         * Hello World Route
         */
        $this->klein->respond('GET', '/hello-world', function () {
            $this->routeData = $this->buildReturnData('Cim_Frontend_Page_HelloWorld');
        });

        /**
         * login-test
         */
        $this->klein->respond('GET', '/login-test', function () {
            $this->routeData = $this->buildReturnData('Cim_Frontend_Page_LoginTest');
        });

        /**
         * login-test
         */
        $this->klein->respond('GET', '/login', function () {
            $this->routeData = $this->buildReturnData('Cim_Frontend_Page_Login');
        });

        $this->generateServicesData();

        /**
         * 404 Route
         */
        $this->klein->onHttpError(function ($code, $router) {
            $returnData = [
                'code' => $code,
            ];
            $this->routeData = $this->buildReturnData('Cim_Frontend_Page_ErrorPage', $returnData);
        });

        $this->klein->dispatch();
    }

    public function generateServicesData()
    {
        /**
         * Entry/Homepage Route
         */
        $this->klein->respond('GET', '/services/login', function () {
            $this->routeData = $this->buildReturnData('Cim_Frontend_Service_login');
        });
    }

    public function getRouteData()
    {
        return $this->routeData;
    }

    /**
     * This function easily generates the return array for routes
     *
     * @param string $handlerClass
     * @param array $requestData
     * @return array
     */
    private function buildReturnData($handlerClass, $requestData = [])
    {
        return [
            'handler' => $handlerClass,
            'requestData' => $requestData,
        ];
    }
}

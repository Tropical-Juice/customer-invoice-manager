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
    /** @var Frontend_Sessions|null  */
    private static $_instance = null;
    /** @var bool */
    private static $_isClosed = false;
    /** @var array */
    private $sessionData;

    public function __construct()
    {
        $this->sessionData = $_SESSION;
    }

    public static function get($key, $default = false)
    {
        $sessions = self::getInstance();
        Util::arrayGet($sessions->getSessionData(), $key, $default);
    }

    public static function store($key, $data)
    {
        if(self::$_isClosed)
            return false;

        $sessions = self::getInstance();
        $sessions->storeSessionData($key, $data);
    }

    public static function closeSessions()
    {
        $sessions = self::getInstance();
        $sessions->sessionSave();

        self::$_isClosed = true;
    }

    /**
     * @return Frontend_Sessions
     */
    private static function getInstance()
    {
        if(self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * @return array
     */
    private function getSessionData()
    {
        return $this->sessionData;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    private function storeSessionData($key, $value)
    {
        $this->sessionData[$key] = $value;
    }

    private function sessionSave()
    {
        $_SESSION = $this->sessionData;
    }
}

<?php
/**
 * Cim - A simple invoice manager
 *
 * @author      Sem Schilder <sem@tropical.email>
 * @copyright   (c) Sem Schilder
 * @link        https://github.com/xvilo/customer-invoice-manager
 */

/**
 * Class Settings
 */
class Settings
{
    /** @var array */
    private $settings;
    /** @var Settings|null */
    private static $instance = null;

    /**
     * Settings constructor.
     * @param $settings array of settings. Key => Value pair
     */
    public function __construct($settings = [])
    {
        $this->settings = Util::makeSureIsArray($settings);
    }

    /**
     * Make this capsule instance available globally.
     *
     * @return void
     */
    public function setAsGlobal()
    {
        static::$instance = $this;
    }

    /**
     * Get setting by key in object state.
     *
     * @param $key String The settings key
     * @param null $default mixed The default if setting is not present
     * @return mixed|null
     */
    public function getObject($key, $default = null)
    {
        if (isset($this->settings[$key])) {
            return $this->settings[$key];
        } else {
            return $default;
        }
    }

    /**
     * Get setting by key in static state.
     * First gets the objects' instance and then calls the function
     *
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public static function getStatic($key, $default = null)
    {
        $instance = self::getInstance();
        return $instance->getObject($key, $default);
    }

    /**
     * Returns instance for global state.
     *
     * @return Settings
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Maps get function name to be callable in
     * object and static context.
     * For object context calls
     *
     * @param $name
     * @param $arguments
     * @return mixed|null
     */
    public function __call($name, $arguments)
    {
        if (!isset($arguments[1])) {
            $arguments[1] = null;
        }

        if ($name === 'get') {
            return call_user_func(array($this, 'getObject'), $arguments[0], $arguments[1]);
        }
    }

    /**
     * Maps get function name to be callable in
     * object and static context.
     * For object static calls
     *
     * @param $name
     * @param $arguments
     * @return mixed|null
     */
    public static function __callStatic($name, $arguments)
    {
        if (!isset($arguments[1])) {
            $arguments[1] = null;
        }

        if ($name === 'get') {
            return call_user_func(array('Settings', 'getStatic'), $arguments[0], $arguments[1]);
        }
    }
}

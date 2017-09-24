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
    /**
     * @var Array all settings from settings file.
     */
    private $settings;

    /**
     * @var Settings current instance when set as global.
     */
    private static $instance;

    /**
     * Settings constructor.
     * @param $settings array of settings. Key => Value pair
     */
    public function __construct($settings)
    {
        $this->settings = $settings;
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

    public static function getStatic($key, $default = null)
    {
        $instance = self::$instance;
        return $instance->getObject($key, $default);
    }

    public static function getInstance()
    {
        return static::$instance;
    }

    public function __call($name, $arguments) {
        if ($name === 'get') {
            return call_user_func(array($this, 'getObject'), $arguments[0], $arguments[1]);
        }
    }

    public static function __callStatic($name, $arguments) {
        if ($name === 'get') {
            return call_user_func(array('Settings', 'getStatic'), $arguments[0], $arguments[1]);
        }
    }
}
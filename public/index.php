<?php
/**
 * Cim - A simple invoice manager
 *
 * @author      Sem Schilder <sem@tropical.email>
 * @copyright   (c) Sem Schilder
 * @link        https://github.com/xvilo/customer-invoice-manager
 */

// Autoloading all composer packages
require_once __DIR__.'/../vendor/autoload.php';

// Autoloading all customer classes
require_once __DIR__.'/../private/autoload.php';

// Get basic settings
require_once __DIR__.'/../settings.php';

$app = new Cim($settings);

try {
    $app->run();
} catch (TodoException $e) {
    die($e->getMessage());
}
<?php

/**
 *  The autoloader
 *
 *  @author Michael van der Werve
 */

require_once 'config.php';
require_once 'vendor/autoload.php';

/**
 * PHPMailer SPL autoloader.
 * @param string $classname The name of the class to load
 */
function Autoload($classname)
{
    //Can't use __DIR__ as it's only in PHP 5.3+
    $filename = dirname(__FILE__).DIRECTORY_SEPARATOR.'class.'.$classname.'.php';
    if (is_readable($filename)) {
        require $filename;
    }
}

if (version_compare(PHP_VERSION, '5.1.2', '>=')) {
    //SPL autoloading was introduced in PHP 5.1.2
    if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
        spl_autoload_register('Autoload', true, true);
    } else {
        spl_autoload_register('Autoload');
    }
} else {
    /**
     * Fall back to traditional autoload for old PHP versions
     * @param string $classname The name of the class to load
     */
    function __autoload($classname)
    {
        Autoload($classname);
    }
}

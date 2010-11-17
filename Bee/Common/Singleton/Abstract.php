<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * Singleton Abstract class
 */
abstract class Bee_Common_Singleton_Abstract{
    private static $_instance;

    abstract protected function __construct();

    public static function getInstance() 
    {
        $thisClass = get_called_class();

        if (!isset(self::$_instance[$thisClass])) {
            self::$_instance[$thisClass] = new $thisClass;
        }

        return self::$_instance[$thisClass];
    }
}

<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * Singleton Abstract class
 */
abstract class System_SingletonAbstract{
    private static $_instance;

    abstract protected function __construct();

    public static function getInstance() 
    {
        if (!isset(self::$_instance)) {
            $thisClass = get_called_class();
            self::$_instance = new $thisClass;
        }

        return self::$_instance;
    }
}

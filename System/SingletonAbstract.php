<?php

abstract class System_SingletonAbstract{
    private static $instance;

    abstract protected function __construct();

    public static function getInstance() 
    {
        if (!isset(self::$instance)) {
            $thisClass = get_called_class();
            self::$instance = new $thisClass;
        }

        return self::$instance;
    }


}

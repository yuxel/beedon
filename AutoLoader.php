<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * autoloader
 *
 * AutoLoad class' php files with this directory structure
 *
 *  Foo_Bar will include Foo/Bar.php
 *  Model_Abraka_Dabra_Truba will include Model/Abraka/Dabra/Truba.php
 */

class AutoLoader{

    private static $_instance;
    private $_externalSources = array();
    private $_classSeparator = "_";
    private $_dirSeparator   = "/";
    private $_extension      = ".php";

    /**
     * get singleton instance 
     */
    public static function getInstance() 
    {
        if (!isset(self::$_instance)) {
            $thisClass = get_called_class();
            self::$_instance = new $thisClass;
        }

        return self::$_instance;
    }

    /**
     * Register handler on construct
     */
    protected function __construct(){
        $this->_register();
    }

    /**
     * This method will handle autoload events
     */
    function loadHandler($className){

        $requirePath = null;

        // Look for external resources and include source path 
        foreach((array)$this->_externalSources as $sourceName=>$sourcePath){
            if($className == $sourceName) {
                $requirePath = $sourcePath;
            }
        }

        if(!$requirePath) {
            // explode class name and include file 
            $namespaces = explode($this->_classSeparator,$className);
            $filepath   = implode($this->_dirSeparator,$namespaces);
            $requirePath   = $filepath . $this->_extension;
        }


        if( file_exists($requirePath)) {
            require_once($requirePath);
        }
    }


    /**
     * Add external resources to include
     */
    function addExternalSource($className, $path){
        $this->_externalSources[$className] = $path;
    }

    /**
     * Register autoloader handler
     */
    function _register(){
        spl_autoload_register(array($this, "loadHandler"));
    }
}

$autoLoader = AutoLoader::getInstance();

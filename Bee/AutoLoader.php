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

class Bee_AutoLoader{

    private static $_instance;
    private $_externalSources = array();
    private $_externalSourcesKeys = array();
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

        //determine file will be required or handled by another source
        $requireFile = true;

        foreach($this->_externalSourcesKeys as $sourceKey){
            $strpos = strpos($className, $sourceKey);
            if ( $className != $sourceKey && $strpos > -1 ) {
                //let it be handled by another external source
                $requireFile = false;
                break;
            }
        }

        if ( $requireFile ) {
            require_once($requirePath);
        }
    }


    /**
     * Add external resources to include
     */
    function addExternalSource($className, $path){
        $this->_externalSources[$className] = $path;
        $this->_externalSourcesKeys = array_keys($this->_externalSources);
    }

    /**
     * Register autoloader handler
     */
    function _register(){
        $this->addNewHandler(array($this, "loadHandler"));
    }

    function addNewHandler($handler){
        spl_autoload_register($handler);
    }

}

$autoLoader = Bee_AutoLoader::getInstance();

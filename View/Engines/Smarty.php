<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * Smarty entegration
 */
class View_Engines_Smarty extends System_SingletonAbstract implements System_ViewInterface{

    /**
     * Set engine with default parameters
     */
    protected function __construct(){
        $autoLoader = AutoLoader::getInstance();
        $autoLoader->addExternalSource("Smarty", "3rdParty/Smarty/libs/Smarty.class.php");

        $this->engine = new Smarty();

        //set template_dir, compile_dir and cache_dir
        $this->engine->template_dir = Config_View::THEME_DIR . DIRECTORY_SEPARATOR . Config_View::THEME;
        $this->engine->compile_dir = Config_View::COMPILE_DIR;
        $this->engine->cache_dir    = Config_View::CACHE_DIR;

    }

    
    /**
     * Assign variable to variableName
     *
     * @param string $variableName : name of view models variable
     * @param mixed $variable : content of variable
     */
    function assign($variableName, $variable) {
        return $this->engine->assign($variableName, $variable);
    }
    

    /**
     * Return content of template file with assigned variables
     *
     * @param string $templateFile
     */
    function fetch($templateFile) {
        return $this->engine->fetch($templateFile);
    }


    /**
     * Display content of fetched file
     *
     * @param string $templateFile
     */
    function display($templateFile) {
        echo $this->fetch($templateFile);
    }

}

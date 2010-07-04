<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * Abstract class for Controllers
 */
abstract class System_ControllerAbstract{
    private $_viewFile = null;

    /**
     * Set view accessible in controller
     */
    function setView($view){
        $this->view = $view;
    }

    /**
     * set router to get parameters
     */
    function setRouter($router){
        $this->router = $router;
    }

    /**
     * get all parameters from router
     */
    function getParameters(){
        return $this->router->getParameters();

    }
    
    /**
     * get a parameter with $key
     */
    function getParameter($key){
        return $this->router->getParameter($key);
    }


    /**
     * Render related file
     */
    function renderView(){

        //users can assign _viewFile
        //if so render _viewFile
        if(!$this->_viewFile){
            $controller = $this->router->getController();
            $action     = $this->router->getAction();
            $seprator   = DIRECTORY_SEPARATOR;
            $file = $controller . $seprator . $action;
        }
        else{
            $file = $this->_viewFile; 
        }


        $this->view->display($file . Config_View::EXTENSION);
    }

    /**
     * Set _viewFile to be rendered
     */
    function setViewFile($fileName){
        $this->_viewFile = $fileName;
    }

    //this should be implemented on all controllers
    abstract function index();
}

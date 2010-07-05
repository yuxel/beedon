<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * Abstract class for Controllers
 */
abstract class Beedon_Controller_Abstract{
    private $_viewFile = null;

    /**
     * Set view accessible in controller
     */
    function setView($view){
        $this->view = $view;
    }

    /**
     * Set model accessible in controller
     */
    function setModel($model){
        $this->model = $model;
    }


    /**
     * set requestHandler to get parameters
     */
    function setRequestHandler($requestHandler){
        $this->requestHandler = $requestHandler;
    }

    /**
     * get all parameters from requestHandler
     */
    function getParameters(){
        return $this->requestHandler->getParameters();

    }
    
    /**
     * get a parameter with $key
     */
    function getParameter($key){
        return $this->requestHandler->getParameter($key);
    }


    /**
     * Render related file
     */
    function renderView(){

        //users can assign _viewFile
        //if so render _viewFile
        if(!$this->_viewFile){
            $controller = $this->requestHandler->getController();
            $action     = $this->requestHandler->getAction();
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

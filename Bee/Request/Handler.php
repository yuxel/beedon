<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * Request handler
 */
class Bee_Request_Handler{
    
    private $_splitted;
    private $_parameters;

    function __construct(){
        $this->_splitUri();         
    }

    /**
     * Split uri by seperator and splitter
     * @see http://www.phpaddiction.com/tags/axial/url-routing-with-php-part-one/
     */
    function _splitUri(){

        $requestURIWithoutGet = explode("?",$_SERVER['REQUEST_URI']);
        $requestURIWithoutGet = rtrim($requestURIWithoutGet[0],"/");
        $requestURI = explode('/', trim($requestURIWithoutGet));

        $scriptName = explode('/',$_SERVER['SCRIPT_NAME']);

        for($i= 0;$i < sizeof($scriptName);$i++) {
            if( isset($requestURI[$i]) ) {
                if ($requestURI[$i] == $scriptName[$i]) {
                    unset($requestURI[$i]);
                }
            }
        }

        $this->_splitted = array_values($requestURI);

    }

    /**
     * return name of controller
     * fallback to default controller
     */
    function getController(){
        $controller = null;

        if(isset($this->_splitted[0])){
            $controller = $this->_splitted[0];
        }

        if(!$controller){
            $controller = Config_Application::DEFAULT_CONTROLLER;
        }

        return $controller;
    }

    /**
     * return name of action
     * fallback to default action
     */
    function getAction(){
        $action = null;

        if(isset($this->_splitted[1])){
            $action = $this->_splitted[1];
        }

        if(!$action){
            $action = Config_Application::DEFAULT_ACTION;
        }
        return $action;
    }


    /**
     * get all parameters
     * POST > GET > URI
     */
    function getParameters(){
        //lazy load parameters
        if(!$this->_parameters) {
            $uriParams = array();
            $sliced = array_slice((array)$this->_splitted, 2);

            $arrayCount = count($sliced);

            for($i=0;$i<$arrayCount;$i=$i+2){
                $key = $sliced[$i];
                $value = !empty($sliced[$i+1]) ? $sliced[$i+1] : null;
                $uriParams[$key] = $value;
            }

            $this->_parameters = array_merge((array)$uriParams, (array)$_GET, (array)$_POST);
        }
        return $this->_parameters;
    }

    /**
     * get specific parameter
     */
    function getParameter($key){
        $params = $this->getParameters(); //lazy load
        $parameter = isset($params[$key]) ? $params[$key] : null;

        return $parameter;
    }


    /**
     * return controller object and action
     * fallback to error controller
     */
    function getControllerAndAction(){

        $controller = $this->getController();
        $action = $this->getAction();

        $controllerClass = "Controller_" . ucfirst($controller);
        $actionMethod = strtolower($action);

        if(class_exists($controllerClass)) {
            $controllerObject = new $controllerClass;
            if(!is_callable(array($controllerObject, $actionMethod))){
                throw new Exception(__CLASS__ ." :: Action '$action' not found");
            }
        }
        else{
            throw new Exception(__CLASS__ . " :: Controller '$controller' not found");
        }

        return array("controller"=>$controllerObject,
                     "action"=>$actionMethod,
                     "parameter"=>null);
    }

}

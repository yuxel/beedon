<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * Abstract class for Controllers
 */
abstract class Bee_Controller_Abstract{
    private $_viewFile = null;

    /**
     * Set view accessible in controller
     */
    function setView($view){
        $this->view = $view;

        $controller = $this->requestHandler->getController();
        $action = $this->requestHandler->getAction();

        $controllerAndAction = array("controller"=>$controller,
                                     "action"=>$action);
 
        $this->view->assign("_controllerAndAction", (object) $controllerAndAction);
    }

    /**
     * Set model accessible in controller
     */
    function setModel($model){
        $this->model = $model;
    }

    function setSession($session){
        $this->session = $session;
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

    function getParametersAsArray(){
        return $this->requestHandler->getParametersAsArray();
    }
    
    /**
     * get a parameter with $key
     */
    function getParameter($key, $defaultValue=null){
        return $this->requestHandler->getParameter($key, $defaultValue);
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


        $responseType = "fullHtml";


        if ( isset( $_REQUEST['_returnType'] ) ) {
            if ( $_REQUEST['_returnType'] == "json" ) {
                $responseType = "json";
            }
            else if ( $_REQUEST['_returnType'] == "partialHtml" ) {
                $responseType = "partialHtml";
            }
        }

        else if ( isset($_SERVER['HTTP_X_REQUESTED_WITH']) ) {
            $responseType = "partialHtml";
        }





        if ( $responseType == "fullHtml" ) {
            $controllerName = $this->requestHandler->getController();

            if($controllerName == "admin"){
                $data = $this->view->fetch($file . Config_View::EXTENSION);
                $this->view->assign("content", $data);
                $this->view->display("_common/adminLayout" . Config_View::EXTENSION);
            }
            else {
                $data = $this->view->fetch($file . Config_View::EXTENSION);
                $this->view->assign("content", $data);
                $this->view->display("_common/layout" . Config_View::EXTENSION);
            }


        }
        elseif ( $responseType == "partialHtml") {
            $this->view->display($file . Config_View::EXTENSION);
        }
        elseif ( $responseType == "json" ) {
            $assignedVars = $this->view->getAssignedVariables();

            foreach($assignedVars as $key=>$value){
                $isPrivate = (strpos($key, "_") === 0)?true:false;
                if ( $isPrivate ) {
                    unset($assignedVars[$key]);
                }
            }

            unset($assignedVars["SCRIPT_NAME"]);
          
            $encoded = json_encode ( $assignedVars );

            echo $encoded;
        }
    }

    /**
     * Set _viewFile to be rendered
     */
    function setViewFile($fileName){
        $this->_viewFile = $fileName;
    }

    function callAdminMethod($caller){
        return $this->admin($caller);
    }

    function preDispatch(){}
    function postDispatch(){}
    function index(){}
}

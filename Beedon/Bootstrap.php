<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * init Model/View and Controller
 */
class Beedon_Bootstrap{

    private $_view;

    private $_model;

    /**
     * Init model 
     */
    public function initModel() {
        $this->_model = Beedon_Model::factory(Config_Model::ENGINE);
        //$this->_model->generateFromTable();
        return $this;
    }

    /**
     * Init View
     */
    public function initView() {
        $this->_view = Beedon_View::factory(Config_View::ENGINE);
        return $this;
    }

    /**
     * get controller and run action from requestHandler
     */
    public function initController(){
        $requestHandler = new Beedon_Request_Handler();
        $actionArgs = null;
        try{
            $controllerAndAction = $requestHandler->getControllerAndAction();
            $controller = $controllerAndAction["controller"];
            $action     = $controllerAndAction["action"];
        }
        catch(Exception $e) {
            $controller = new Controller_Error();
            $action     = "showError";
            $actionArgs = $e->getMessage();
        }

        $controller->setModel($this->_model);
        $controller->setView($this->_view);
        $controller->setRequestHandler($requestHandler);

        call_user_func(array($controller, $action), $actionArgs);

        $controller->renderView();

        return $this;
    }

} 

<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * init Model/View and Controller
 */
class Beedon_Bootstrap{

    public function initModel() {
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
        $requestHandler = new Beedon_RequestHandler();
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

        $controller->setView($this->_view);
        $controller->setRequestHandler($requestHandler);

        call_user_func(array($controller, $action), $actionArgs);

        $controller->renderView();

        return $this;
    }

} 

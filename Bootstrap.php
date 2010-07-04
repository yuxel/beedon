<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * init Model/View and Controller
 */
class Bootstrap{

    public function initModel() {
        return $this;
    }

    /**
     * Init View
     */
    public function initView() {
        $this->_view = View::factory(Config_View::ENGINE);
        return $this;
    }

    /**
     * get controller and run action from router
     */
    public function initController(){
        $router = new System_Router();
        $actionArgs = null;
        try{
            $controllerAndAction = $router->getControllerAndAction();
            $controller = $controllerAndAction["controller"];
            $action     = $controllerAndAction["action"];
        }
        catch(Exception $e) {
            $controller = new Controller_Error();
            $action     = "showError";
            $actionArgs = $e->getMessage();
        }

        $controller->setView($this->_view);
        $controller->setRouter($router);

        call_user_func(array($controller, $action), $actionArgs);

        $controller->renderView();

        return $this;
    }

} 

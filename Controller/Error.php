<?php
class Controller_Error extends System_ControllerAbstract{
    function showError($messages){
        $this->setViewFile("error/showMessage");
        $this->view->assign("errorMessage",$messages);
    }

    function index(){
    }
}

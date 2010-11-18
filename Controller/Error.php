<?php
class Controller_Error extends App_ControllerBase{
    function showError($messages){
        $this->setViewFile("error/showMessage");
        $this->view->assign("errorMessage",$messages);
    }
}

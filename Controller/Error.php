<?php
class Controller_Error extends Beedon_Controller_Abstract{
    function showError($messages){
        $this->setViewFile("error/showMessage");
        $this->view->assign("errorMessage",$messages);
    }

    function index(){
    }
}

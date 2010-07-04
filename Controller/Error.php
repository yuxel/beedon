<?php
class Controller_Error extends System_ControllerAbstract{
    function showError($messages){
        $this->messages = $messages;
        return $messages;
    }

    function index(){
    }
}

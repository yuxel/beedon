<?php

class Controller_Admin extends App_ControllerBase{

    function index(){
        $this->_callAdminMethod("index");
    }

    function __call($name, $args){
        $this->_callAdminMethod($name);
    }


    private function _callAdminMethod($controller){
        $calleeClass = "Controller_" . ucfirst($controller);
        $this->setViewFile($controller."/admin");
        $callee = new $calleeClass;
        $callee->admin($this);
    }
}

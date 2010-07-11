<?php

class Controller_Index extends Beedon_Controller_Abstract{
    function index(){
        $this->setViewFile("_common/index");
        //this will compile index/index.tpl
    }

    function ie6(){
        $this->setViewFile("_common/ie6");
        //this will compile index/index.tpl
    }

}

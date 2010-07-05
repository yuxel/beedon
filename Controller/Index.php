<?php

class Controller_Index extends Beedon_Controller_Abstract{
    function index(){
        $this->setViewFile("_common/index");
        //this will compile index/index.tpl
    }
}

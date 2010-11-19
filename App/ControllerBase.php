<?php

class App_ControllerBase extends Bee_Controller_Abstract{
    private $constants;

    private function _setLayoutConstants(){
        $this->constants = new StdClass();
        $this->constants->header->slogan = "Can't stop learning!";
        $this->constants->header->globalTitle = "Osman Yuksel | ";
        $this->constants->header->globalTitle .= $this->constants->header->slogan;
        $this->constants->footer->behindTheSite = "Beedon, php, html5, css3, jquery";
        $this->constants->footer->goodSites = array("site1", "site2");
        $this->constants->footer->aboutAuthor = "Burası da benim hakımda sayfası";
    }

    private function _assignLayoutConstants(){
        $this->view->assign("_layoutConstants", $this->constants);
    }

    function preDispatch(){
        $this->_setLayoutConstants();
    }

    protected function _setPageTitle($title){
        $this->constants->header->title = $title;
    }

    function postDispatch(){
        $this->_assignLayoutConstants();
    }
}

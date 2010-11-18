<?php

class App_ControllerBase extends Bee_Controller_Abstract{
    private $constants;

    private function _setLayoutConstants(){
        $this->constants = new StdClass();
        $this->constants->header->globalTitle = "Burasu başlık";
        $this->constants->header->slogan = "Bu slogan";
        $this->constants->footer->behindTheSite = "Burası behind the site";
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

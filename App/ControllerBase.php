<?php

class App_ControllerBase extends Bee_Controller_Abstract{

    function getLayoutConstants(){
        $constants = new StdClass();
        $constants->header->title = "Burasu başlık";
        $constants->header->slogan = "Bu slogan";
        $constants->footer->behindTheSite = "Burası behind the site";
        $constants->footer->goodSites = array("site1", "site2");
        $constants->footer->aboutAuthor = "Burası da benim hakımda sayfası";
        return $constants;
    }

    function setLayoutConstants(){
        $this->view->assign("layoutConstants", $this->getLayoutConstants());
    }

    function postDispatch(){
        $this->setLayoutConstants();
    }
}

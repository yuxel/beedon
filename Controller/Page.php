<?php

class Controller_Page extends App_ControllerBase{
    function __construct(){
        $this->pageService = new Service_Page();
    }


    private function _show($link){
        $this->setViewFile("page/show");
        $content = $this->pageService->getPageContentByLink($link);
        $this->view->assign("pageContent", $content);
    }


    public function __call($name, $arguments) {
        $params = $this->getParametersAsArray();
        $link = implode("/",array_slice($params, 1));

        $this->_show($link);
    }
}

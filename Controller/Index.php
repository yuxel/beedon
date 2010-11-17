<?php

class Controller_Index extends Bee_Controller_Abstract{

    function __construct(){
        $this->articleService = new Service_Article();
    }

    function index(){
        $latestArticles = $this->articleService->getLatestActiveArticles();
        $this->view->assign("latestArticles", $latestArticles);
        $this->setViewFile("article/list");
    }
}

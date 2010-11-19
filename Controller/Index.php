<?php

class Controller_Index extends App_ControllerBase{

    function __construct(){
        $this->articleService = new Service_Article();
    }

    function index(){
        $limit = 20;
        $page = $this->getParameter("page", 1);

        $offset = ($page - 1) * $limit;

        $latestArticles = $this->articleService->getLatestActiveArticles($limit, $offset);
        $this->view->assign("latestArticles", $latestArticles);
        $this->setViewFile("article/list");
    }
}

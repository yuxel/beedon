<?php

class Controller_Article extends Bee_Controller_Abstract{

    function __construct(){
        $this->articleService = new Service_Article();
    }

    function index(){}

    function show(){
        $url = end(array_keys($this->getParameters()));
        $article = $this->articleService->getArticleByUrl($url);
        $this->view->assign("article", $article);
    }
}

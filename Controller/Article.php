<?php

class Controller_Article extends App_ControllerBase{

    function __construct(){
        $this->articleService = new Service_Article();
    }

    function show(){
        $url = end(array_keys($this->getParameters()));
        $article = $this->articleService->getArticleByUrl($url);

        $this->view->assign("article", $article);
        $this->_setPageTitle($article->title);
    }
}

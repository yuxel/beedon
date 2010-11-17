<?php

class Service_Article{
    public function getLatestActiveArticles($limit=20, $offset=0){

        $articles = array();

        $article = new StdClass();
        $article->id = 1;
        $article->sender = 1; //TODO: get userData
        $article->title = "Bu başlık";
        $article->text = "Burası da içerik";
        $article->url = "burasi-da-icerik-".$article->id;
        $article->time = time();
        $article->commentCount = 10;
        $article->status = "active";
        $article->tags = array("1"=>"Deneme",
                               "2"=>"Falan",
                               "4"=>"Molan");

        $articles[] = $article;
        $articles[] = $article;
        $articles[] = $article;
        $articles[] = $article;

        return $articles;
    }

    public function getArticleByUrl($url){
        $urlData = explode("-", $url);
        $id = (int) end($urlData);

        $articles = $this->getLatestActiveArticles();
        $article = end($articles);

        return $article;
    }

}

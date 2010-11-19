<?php

class Service_Article{

    public function __construct(){
        $this->articleTable = ArticleTable::getInstance();
    }


    public function getAllActiveArticlesCount(){

        $articleCount = $this->articleTable
                             ->findByStatus('active')
                             ->count();

        return $articleCount;
    }

    private function _populateArticle($article){
        $cleanUrl = Util_String::toUrl($article->title);
        $article->url = $cleanUrl . "-" . $article->id;
        $article->sender = ""; //TODO
        $article->commentCount = "10"; //TODO
        $article->tags = ""; //TODO

        unset($article->status);
    }

    public function getArticleById($id){

        $articleData = $this->articleTable->findOneById($id)->getData();
        $articleData = (object) $articleData;

        $this->_populateArticle($articleData);
        return $articleData;
    }

    public function getLatestActiveArticles($limit=20, $offset=0){
        $articleCount = $this->getAllActiveArticlesCount();

        //TODO : handle max offset, limit etc
        if($offset < 0){
            $offset = 0;
        }
        else if($offset > $articleCount){
            $offset = $articleCount;
        }

        if(($limit + $offset) > $articleCount){
            //$offset = $articleCount;
        }

        $q = Doctrine_Query::create()
             ->select('a.*')
             ->from('Article a')
             ->where("a.status = 'active'")
             ->orderBy("a.timeAdded desc")
             ->limit($limit)
             ->offset($offset);



        $results = $q->execute()->toArray();
        $articles = Util_Doctrine::toObject($results);

        foreach($articles as $article){
            $this->_populateArticle($article);
        }



        $pagination = array("limit"=>$limit,
                            "offset"=>$offset,
                            "total" => $articleCount);

        $result = new StdClass();
        $result->articles = $articles;
        $result->pagination = $pagination;

        return $result;
    }

    public function getArticleByUrl($url){
        $urlData = explode("-", $url);
        $id = (int) end($urlData);

        $article = $this->getArticleById($id);
        return $article;
    }

}

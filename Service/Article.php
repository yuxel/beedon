<?php

class Service_Article{

    public function __construct(){
        $this->articleTable = ArticleTable::getInstance();
        $this->userService = new Service_User(); //TODO: singleton
        $this->tagService = new Service_Tag(); //TODO: singleton
        $this->commentService = new Service_Comment(); //TODO: singleton
    }


    public function getAllActiveArticlesCount(){
        $articleCount = $this->articleTable
                             ->findByStatus('active')
                             ->count();

        return $articleCount;
    }

    private function _filterArticle($article){
        $cleanUrl = Util_String::toUrl($article->title);
        $article->url = $cleanUrl . "-" . $article->id;
        $article->sender = $this->userService->getActiveUserById($article->senderId);
        $article->commentCount = $this->commentService->getAllActiveCommentCount($article->id, "article");
        $article->tags = $this->tagService->getActiveTagsFromString($article->tags);

        unset($article->status);
    }

    public function getArticleById($id){

        $articleData = $this->articleTable->findOneById($id)->getData();
        $articleData = (object) $articleData;

        $this->_filterArticle($articleData);
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
            $this->_filterArticle($article);
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

        $limit = 9999;
        $offset = 0;
        $article->comments = $this->commentService
                                  ->getActiveComments($article->id, 'article', $limit, $offset);
        return $article;
    }
}

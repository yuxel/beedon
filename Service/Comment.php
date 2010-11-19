<?php

class Service_Comment{

    public function __construct(){
        $this->commentTable = ContentCommentTable::getInstance();
        $this->userService = new Service_User(); //TODO: singleton
    }


    public function getAllActiveCommentCount($relatedId, $relatedType){
        $q = Doctrine_Query::create()
             ->select('c.*')
             ->from('ContentComment c')
             ->where("c.status = 'active'")
             ->andWhere("c.relatedId = ?", $relatedId)
             ->andWhere('c.contentType = ?', $relatedType);

        $articleCount = $q->execute()->count();
        return $articleCount;
    }


    private function _filterComment($comment){
        unset($comment->status);
        unset($comment->contentType);
        unset($comment->relatedId);
    }


    function getActiveComments($relatedId, $relatedType, $limit=10, $offset=0){
        $commentCount = $this->getAllActiveCommentCount($relatedId, $relatedType);

        $q = Doctrine_Query::create()
             ->select('c.*')
             ->from('ContentComment c')
             ->where("c.status = 'active'")
             ->andWhere("c.relatedId = ?", $relatedId)
             ->andWhere('c.contentType = ?', $relatedType)
             ->orderBy("c.timeAdded desc")
             ->limit($limit)
             ->offset($offset);

        $results = $q->execute()->toArray();
        $comments = Util_Doctrine::toObject($results);

        foreach($comments as $comment){
            $this->_filterComment($comment);
        }

        $pagination = array("limit"=>$limit,
                            "offset"=>$offset,
                            "total" => $commentCount);

        $result = new StdClass();
        
        $result->comments = $comments;
        $result->pagination = $pagination;

        return $result;
    }

}

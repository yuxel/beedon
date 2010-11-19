<?php

class Service_Tag{

    public function __construct(){
        $this->tagTable = TagTable::getInstance();
    }

    public function _filterTag($tag){
        unset($tag->status);
    }


    /**
     * Get tags from string seperated with commas
     */
    public function getActiveTagsFromIds($string){
        $ids = explode(",", $string);
        $ids = Util_Array::filterNumbers($ids);

        $q = Doctrine_Query::create()
             ->select('t.*')
             ->from('Tag t')
             ->where("t.status = 'active'")
             ->andWhereIn("t.id", $ids);

        $tags = $q->execute()->toArray();
        $tags = Util_Doctrine::toObject($tags);

        foreach($tags as $tag){
            $this->_filterTag($tag);
        }

        return $tags;
    }
}

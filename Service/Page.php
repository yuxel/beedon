<?php

class Service_Page{

    public function __construct(){
        $this->pageTable = PageTable::getInstance();
    }

    public function getPageContentByLink($link){
        $data = $this->pageTable->findOneByLink($link);
        $content = false;

        if($data){
            $content = $data->content;
        }

        return $content;
    }
}

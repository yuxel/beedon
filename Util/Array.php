<?php

class Util_Array{
    static function filterNumbers($array){
        foreach($array as $key=>$item){
            if(!is_numeric($item)){
                unset($array[$key]);
            }
        }

        return $array;
    }
}

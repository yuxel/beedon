<?php
class Util_Doctrine{
    static function toObject($results){
        $objectArray = array();
        foreach($results as $key=>$result){
            $objectArray[$key] = (object) $result;
        }
        return $objectArray;
    }
}

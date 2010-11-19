<?php

class Util_String {


    static function removeNonAlphaNumeric($string, $replaceWith=" "){
        $string = preg_replace("@[^A-Za-z0-9\-_]+@i", $replaceWith ,$string); 
        return $string;
    }

    static function removeTurkishChars($string) { 
        $find = array("ş","Ş",
                      "ı","İ", 
                      "ü","Ü", 
                      "ö","Ö",
                      "ç","Ç", 
                      "ğ", "Ğ"); 

        $replace=array("s","S",
                       "i", "I",
                       "u", "U",
                       "o", "O",
                       "c", "C",
                       "g", "G"); 

        $string = str_replace($find, $replace, $string); 
        return $string; 
    }


    static function toUrl($string){
        $string = self::removeTurkishChars($string);
        $string = self::removeNonAlphaNumeric($string,"-");
        $string = strtolower($string);
        return $string;
    }


}

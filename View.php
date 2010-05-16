<?php
/**
 * Factory class to set view engine
 */
class View{

   public static function factory($viewEngine) {
        $engineClass = "View_Engines_$viewEngine";
        return $engineClass::getInstance();
    }
    
}

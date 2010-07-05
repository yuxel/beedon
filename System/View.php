<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * Factory class to set view engine
 */
class System_View{

    /**
     * Load related engine
     *
     * @param System_ViewInterface $viewEngine
     */
    public static function factory($viewEngine) {
        $engineClass = "System_View_Engines_$viewEngine";
        return $engineClass::getInstance();
    }

}

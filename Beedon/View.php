<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * Factory class to set view engine
 */
class Beedon_View{

    /**
     * Load related engine
     *
     * @param Beedon_View_Interface $viewEngine
     */
    public static function factory($viewEngine) {
        $engineClass = "Beedon_View_Engines_$viewEngine";
        return $engineClass::getInstance();
    }

}

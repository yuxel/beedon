<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * Factory class to set model
 */
class Beedon_Model{

    /**
     * Load related engine
     *
     */
    public static function factory($modelEngine) {
        $model = "Beedon_Model_Engines_$modelEngine";
        return new $model;
    }

}

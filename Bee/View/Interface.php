<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * View Interface for Bee
 *
 */
interface Bee_View_Interface
{
    /**
     * Fetch template data with assigned variables
     */
    public function fetch($template);

    /**
     * assign variable to variableName
     */
    public function assign($variableName, $variable);

    /**
     * output date on fetched template
     */
    public function display($template);

    /**
     * return template dir path
     */
    public function getTemplatesDir();
}

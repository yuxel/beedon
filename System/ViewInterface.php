<?php
/**
 * View Interface for Beedon
 *
 */
interface System_ViewInterface
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
}

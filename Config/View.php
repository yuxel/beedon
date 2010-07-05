<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * View and template engine configuration
 */
class Config_View{
    const ENGINE      = "Smarty";
    const ENGINE_PATH = "Beedon/3rdParty/Smarty/libs/Smarty.class.php";
    const COMPILE_DIR = "tmp/templates_c";
    const CACHE_DIR   = "tmp/cache";
    const THEME_DIR   = "Templates";
    const THEME       = "default";
    const EXTENSION   = ".tpl";
}

<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * autoloader
 *
 * AutoLoad class' php files with this directory structure
 *
 *  Foo_Bar will include Foo/Bar.php
 *  Model_User will include Model/User.php
 */
function __autoload($className) {
    //exception for smarty
    if($className == "Smarty"){
        require_once ("3rdParty/Smarty/libs/Smarty.class.php");
    }
    else{
        $namespaces = explode("_",$className);
        $filePath   = implode("/",$namespaces);
        require_once( $filePath. ".php");
    }
}

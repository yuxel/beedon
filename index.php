<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

error_reporting(E_ALL);
ini_set("display_errors",true);

define("APP_PATH", dirname(__FILE__));

include_once("Bee/AutoLoader.php");

$bootstrap = new Bee_Bootstrap();

$bootstrap->initModel()
          ->initView()
          ->initController();


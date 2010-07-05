<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

error_reporting(E_ALL);
ini_set("display_errors",true);

include_once("Beedon/AutoLoader.php");

$bootstrap = new Beedon_Bootstrap();

$bootstrap->initModel()
          ->initView()
          ->initController();


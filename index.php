<?

error_reporting(E_ALL);
ini_set("display_errors",true);


include_once("AutoLoader.php");

$bootstrap = new Bootstrap();

$bootstrap->initModel()
          ->initView()
          ->initUrlMapper()
          ->initController();


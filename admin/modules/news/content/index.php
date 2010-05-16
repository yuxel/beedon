<?
include "modules/$a_module/lang/$lang.php";
include "modules/$a_module/include/functions.php";
$impath="image/topics";

$msgfile=file_get_contents("$mtemp_dir/msg.html");

$page=temp_replace("content",$start,$page);
$page=temp_replace("news",_lang_news,$page);
$page=temp_replace("topics",_lang_topics,$page);
$page=temp_replace("setup",_lang_setup,$page);

if(!$action) $page=temp_replace("module_content","",$page);



elseif($action=="news"){
    include "$content_dir/$action.php";
} #action=news

elseif($action=="topics"){
    include "$content_dir/$action.php";
} #action=topics

elseif($action=="setup"){
    include "$content_dir/$action.php";
} #action=setp
else $page=temp_replace("module_content",_lang_module_not_exists,$page);  //eðer bilinmeyen bir $action ise
?>
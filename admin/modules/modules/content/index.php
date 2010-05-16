<?
$msgfile=file_get_contents("$mtemp_dir/msg.html");

$page=temp_replace("content",$start,$page);
$page=temp_replace("edit",_lang_module_edit,$page);
$page=temp_replace("install",_lang_module_install,$page);
$page=temp_replace("remove",_lang_module_remove,$page);

$restricted_modules=array("home","stats","users","admin");

if(!$action) $page=temp_replace("module_content","",$page);
if($action=="edit"){
    include "$content_dir/$action.php";
} #action=edit

if($action=="install"){
    include "$content_dir/$action.php";
} #action=install

if($action=="remove"){
    include "$content_dir/$action.php";

} #action=remove

?>
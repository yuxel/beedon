<?
global $bee_name;
$page=temp_replace("content",$start,$page);
$msgfile=file_get_contents("$mtemp_dir/msg.html");
//
$page=temp_replace("add_new",_lang_add,$page);
$page=temp_replace("edit",_lang_edit,$page);

if(!$action) $page=temp_replace("content","",$page);
if($action=="add") {
    include "$content_dir/$action.php";
} #action = add


if($action=="edit") {
    include "$content_dir/$action.php";

} #action=edit
?>	  
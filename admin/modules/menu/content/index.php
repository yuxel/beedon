<?
$page=temp_replace("content",$start,$page);
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
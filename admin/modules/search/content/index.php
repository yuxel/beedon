<?
/*------------------
Arama yönetim modülü
-------------------*/
$page=temp_replace("content",$start,$page);  //start.html
//
$page=temp_replace("add",_lang_add,$page);
$page=temp_replace("edit",_lang_edit,$page);
$msgfile=file_get_contents("$mtemp_dir/msg.html");

if(!$action) $page=temp_replace("content","",$page);
if($action=="add") { //bloklarý duzenle
include "$content_dir/$action.php";
} #action=edit



if($action=="edit") {  //kendi bloklarýný ayarla
include "$content_dir/$action.php";
} #action=own
?>
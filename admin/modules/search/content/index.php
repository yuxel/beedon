<?
/*------------------
Arama y�netim mod�l�
-------------------*/
$page=temp_replace("content",$start,$page);  //start.html
//
$page=temp_replace("add",_lang_add,$page);
$page=temp_replace("edit",_lang_edit,$page);
$msgfile=file_get_contents("$mtemp_dir/msg.html");

if(!$action) $page=temp_replace("content","",$page);
if($action=="add") { //bloklar� duzenle
include "$content_dir/$action.php";
} #action=edit



if($action=="edit") {  //kendi bloklar�n� ayarla
include "$content_dir/$action.php";
} #action=own
?>
<?
/*------------------
Bloklarý yönetim modülü
-------------------*/
$page=temp_replace("content",$start,$page);  //start.html
//
$page=temp_replace("file_blocks",_lang_file_blocks,$page);
$page=temp_replace("own_blocks",_lang_edit_ownblock,$page);
$page=temp_replace("info_text",_lang_block_info,$page);

$msgfile=file_get_contents("$mtemp_dir/msg.html");

if(!$action) $page=temp_replace("content","",$page);
if($action=="edit") { //bloklarý duzenle
include "$content_dir/$action.php";
} #action=edit



if($action=="own") {  //kendi bloklarýný ayarla
include "$content_dir/$action.php";
} #action=own
?>
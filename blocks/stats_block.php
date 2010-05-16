<?
$lang=$GLOBALS['lang'];
include "modules/stats/lang/$lang.php";
$user_block=file_get_contents("modules/stats/template/blocks/block.html");

global $dbprefix,$countvisitor,$countmembers,$onlinemembers;

$text=str_replace("%visitor",$countvisitor,_lang_whoisonline_text);
$text=str_replace("%member",$countmembers,$text);
$user_block=temp_replace("whoisonline",$text,$user_block);

$block=temp_replace("content",$user_block,$block);
?>
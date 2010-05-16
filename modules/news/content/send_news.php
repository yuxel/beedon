<?
/*-----------------------
Haber gönderme arayüzü
-----------------------*/
//template dosyasýný al
$stemp=file_get_contents("$temp_dir/send_news.html");
if($GLOBALS['bee_name']!="beeman") $sender=$GLOBALS['bee_name'];
else $sender=_lang_anonymous;  //eðer gönderen ziyaretci ise

$page=temp_replace("module",$stemp,$page);
$page=temp_replace("sender",_lang_sender,$page);
$page=temp_replace("time",_lang_date,$page);
$page=temp_replace("header",_lang_header,$page);
$page=temp_replace("topic",_lang_topic,$page);
$page=temp_replace("news",_lang_content,$page);
$page=temp_replace("allowed_tags",_lang_allowed_tags,$page);
$page=temp_replace("submit_text",_lang_submit_text,$page);
$page=temp_replace("user_name",$sender,$page);
$page=temp_replace("user",$GLOBALS['bee_name'],$page);
$page=temp_replace("date",get_date()." ".get_time(),$page);
$page=temp_replace("list_topics",list_topics(),$page);
$page=temp_replace("preview_text",_lang_preview,$page);


?>
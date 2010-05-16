<?
/*-------------------
Gelen habere önizleme
*-----------------*/
//deðerleri al
$sender=htmlspecialchars($_POST['sender']);
$senddate=htmlspecialchars($_POST['senddate']);
$nheader=htmlspecialchars($_POST['nheader']);
$topic=htmlspecialchars($_POST['topic']);   //functions.php
$ncontent=htmlspecialchars($_POST['ncontent']);  //functions.php

if(!$nheader OR !$ncontent) {  //eðer içerik veya baþlýk yoksa
  $page=temp_replace("module",$msg_file,$page);
  $page=temp_replace("msg",_lang_no_header_or_content,$page);
  $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
  $page=forward($back,2,$page);
} #if
else {  
$stemp=file_get_contents("$temp_dir/preview_id.html");
if($GLOBALS['bee_name']!="beeman") $sender=$GLOBALS['bee_name'];
else $sender=_lang_anonymous;  //eðer ziyretci ise


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
$page=temp_replace("date",$senddate,$page);
$page=temp_replace("list_topics",list_topics($topic),$page);
$page=temp_replace("preview_text",_lang_preview,$page);

$topicQuery=@db_query("select image from ${dbprefix}news_topics where tid='$topic'");
while($tlogo=db_fetch_row($topicQuery)){
$topicLogo="image/topics/".$tlogo[0];
}

$exptime=explode(" ",$senddate);
$hour=$exptime[1];
$expdate=explode("-",$exptime[0]);
$year=$expdate[0];
$month=$expdate[1];
$day=$expdate[2];
$dayname=return_dayname($year,$month,$day);    

$page=temp_replace("prev_header","$nheader",$page);
$page=temp_replace("prev_news",to_html($ncontent,1),$page); //1 , preview için
$page=temp_replace("prev_news_textarea",stripslashes($ncontent),$page);
$page=temp_replace("prev_topic_logo","$topicLogo",$page);
$page=temp_replace("prev_date","$senddate",$page);
$page=temp_replace("prev_day",$day,$page);
$page=temp_replace("prev_month",$month,$page);
$page=temp_replace("prev_year",$year,$page);
$page=temp_replace("prev_hour",$hour,$page);
$page=temp_replace("prev_dayname",$dayname,$page);
$page=temp_replace("prev_month_name",return_month_name((int)$month),$page);




} #else



?> 

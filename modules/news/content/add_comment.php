<?
$nid=$_GET['nid']; //news id
$cid=$_GET['cid']; //comment_id

if($auth>1) {
if(!$effect) {



$commentAddTemp=file_get_contents("$temp_dir/add_comments.html"); 
$page=temp_replace("module",$commentAddTemp,$page);
$page=temp_replace("sender",_lang_sender,$page);
$page=temp_replace("time",_lang_date,$page);
$page=temp_replace("header",_lang_header,$page);
$page=temp_replace("writeby",$writeBy,$page);
$page=temp_replace("comment",_lang_comment,$page);
$page=temp_replace("allowed_tags",_lang_allowed_tags,$page);
$page=temp_replace("submit_text",_lang_submit_text,$page);
$page=temp_replace("user_name",$GLOBALS['bee_name'],$page);
$page=temp_replace("date",get_date()." ".get_time(),$page);
$page=temp_replace("nid",$nid,$page);
$page=temp_replace("cid",$cid,$page);
$page=temp_replace("preview_text",_lang_preview,$page);

} #!effect

if($effect=="preview"){

$sender=htmlspecialchars($_POST['sender']);
$senddate=htmlspecialchars($_POST['senddate']);
$nheader=htmlspecialchars($_POST['nheader']);
$topic=htmlspecialchars($_POST['topic']);   //functions.php
$ncontent=htmlspecialchars($_POST['ncontent']);  //functions.php
$cid=(int)$_POST['cid'];
$nid=(int)$_POST['nid'];
$writeBy=htmlspecialchars($_POST['writeby']);  
if(!$nheader OR !$ncontent) {  //eðer içerik veya baþlýk yoksa
  $page=temp_replace("module",$msg_file,$page);
  $page=temp_replace("msg",_lang_no_header_or_content,$page);
  $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
  } #if
else { 
$stemp=file_get_contents("$temp_dir/preview_comment.html");
$page=temp_replace("module",$stemp,$page);

$page=temp_replace("nid",$nid,$page);
$page=temp_replace("cid",$cid,$page);


$page=temp_replace("sender",_lang_sender,$page);
$page=temp_replace("time",_lang_date,$page);
$page=temp_replace("header",_lang_header,$page);
$page=temp_replace("writeby",$writeBy,$page);
$page=temp_replace("comment",_lang_comment,$page);
$page=temp_replace("allowed_tags",_lang_allowed_tags,$page);
$page=temp_replace("submit_text",_lang_submit_text,$page);
$page=temp_replace("user_name",$GLOBALS['bee_name'],$page);
$page=temp_replace("user",$GLOBALS['bee_name'],$page);
$page=temp_replace("date",$senddate,$page);
$page=temp_replace("preview_text",_lang_preview,$page);

$exptime=explode(" ",$senddate);
$hour=$exptime[1];
$expdate=explode("-",$exptime[0]);
$year=$expdate[0];
$month=$expdate[1];
$day=$expdate[2];
$dayname=return_dayname($year,$month,$day);    

$page=temp_replace("prev_header","$nheader",$page);
$page=temp_replace("prev_news",to_html($ncontent),$page);
$page=temp_replace("prev_news_textarea",stripslashes($ncontent),$page);
$page=temp_replace("prev_topic_logo","$topicLogo",$page);
$page=temp_replace("prev_date","$senddate",$page);
$page=temp_replace("prev_day",$day,$page);
$page=temp_replace("prev_month",$month,$page);
$page=temp_replace("prev_year",$year,$page);
$page=temp_replace("prev_hour",$hour,$page);
$page=temp_replace("prev_dayname",$dayname,$page);
$page=temp_replace("prev_month_name",return_month_name((int)$month),$page);

}

} #effect=preview

if($effect=="add"){
$sender=htmlspecialchars($_POST['sender']);
$senddate=htmlspecialchars($_POST['senddate']);
$nheader=htmlspecialchars($_POST['nheader']);
$topic=htmlspecialchars($_POST['topic']);   //functions.php
$ncontent=htmlspecialchars($_POST['ncontent']);  //functions.php
$cid=(int)$_POST['cid'];
$nid=(int)$_POST['nid'];
$writeBy=htmlspecialchars($_POST['writeby']);  

if(!$nheader OR !$ncontent) {  //eðer içerik veya baþlýk yoksa
  $page=temp_replace("module",$msg_file,$page);
  $page=temp_replace("msg",_lang_no_header_or_content,$page);
  $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
  } #if
else {


@db_query("insert into ${dbprefix}news_comments (user,header,content,newsid,related_comment,time) values ('$sender','$nheader','$ncontent','$nid','$cid','$senddate')");

$page=temp_replace("module",$msg_file,$page);
$page=temp_replace("msg",_lang_comment_added,$page);
$page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"?module=home\">"._lang_click_here."</a>",$page);
$page=forward("?module=home",2,$page);

}

} #effect=add


} #auth
else{
$page=temp_replace("module",$msg_file,$page);
$page=temp_replace("msg",_lang_no_access_to_comment,$page);

$page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"?module=home\">"._lang_click_here."</a>",$page);
$page=forward("?module=home",2,$page);

}

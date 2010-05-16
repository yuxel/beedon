<?
/*-------------------
GElen haberi veritabanýna eklegönder
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
  //bilgileri veritabanýna ekle
  @db_query("insert into ${dbprefix}news (header,content,sender,topic,counter,time) values ('$nheader','$ncontent','$sender','$topic','1','$senddate')");
  $page=temp_replace("module",$msg_file,$page);
  $page=temp_replace("msg",_lang_thanks_for_news,$page);
  $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
  $page=forward("?module=home",2,$page);
} #else

?>
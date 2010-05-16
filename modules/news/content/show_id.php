<?
/*-----------------------------
belli bir haberi göster
-----------------------------*/

$id=$_GET['id'];  //haber numarasý al

$newsq=@db_query("select nid,header,content,sender,topic,editor,counter,time,image from ${dbprefix}news, ${dbprefix}news_topics where ${dbprefix}news.topic=${dbprefix}news_topics.tid and editor is not null and nid='$id' order by nid desc");
//haber bilgisi

if(@db_num_rows($newsq)<1) {  //eðer böyle bir haber yoksa
  $page=temp_replace("module",$msg_file,$page);
  $page=temp_replace("msg",_lang_no_news,$page);
  $page=temp_replace("if_not_forward","",$page);
} #if
else{  //varsa
 $out=write_news_content($newsq,0,1,$comment_on);  //<!--split-->'i devre dýþý býrak ve show_id templateini yükle
 @db_query("update ${dbprefix}news set counter=counter+1 where nid='$id'");  //okunma sayýsý bir arttýr
 $page=temp_replace("module",$out,$page);
} #else
?>
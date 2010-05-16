<?
/*----------------------
Konularý ve her konu için olan baþlýklarý listele
-----------------------*/
$topic=$_GET['topic'];  //konu numarasý al

if(!$topic){  //seçili bir konu yok ise tüm konularý listele
$how_many_topic=5;  // ayný sýrada en fazla kaç konu olsun
$counter=0;
$total_count=0;
$topq=@db_query("select * from ${dbprefix}news_topics");  //tüm konular
$topn=@db_num_rows($topq);  //konu sayýsý
$topictemp=file_get_contents("$temp_dir/list_topics.html");  //konu template dosyasý
$page=temp_replace("module",$topictemp,$page);  //bkz : template
$page=temp_replace("topics",_lang_topics,$page);
$msg="<tr>";
while($data=@db_fetch_row($topq)){
$image="<a href=\"?module=news&amp;action=list_topics&amp;topic=$data[0]\"><img src=\"$topics_image/$data[3]\" alt=\"\"></a><br>$data[2]";
if($counter<$how_many_topic){
$msg.="<td>$image</td>";
} #if
if($counter==$how_many_topic){  //sýnýra gelince tabloda yeni bir row oluþtur
$msg.="</tr><tr><td>$image</td>";
$counter=0;   //counter'ý sýfýrla
} #if
$counter++;
} #while
$msg.="</tr>";  //row'u kapat
$page=temp_replace("topic_list",$msg,$page);
} #!$topic
else
{
  $pno=$_GET['pno'];  //sayfa numarasý al
  if(!$pno) $pno=1;   //öntanýmlý = 1

  $numq=@db_query("select * from ${dbprefix}news_setup");
  while($dt=db_fetch_row($numq)){  //haber özellikleri
    $range=$dt[0];   //ayný sayfada kaç haber olacak
    //$comment_on=$dt[1];
    //$comment_type=$dt[2];
  } #while

$start=($pno-1)*$range;  //mysql limit baþlangýcý
$totq=@db_query("select * from ${dbprefix}news where topic='$topic' and editor is not null order by nid desc");  // ayný konudan kaç haber var ?
$total=@db_num_rows($totq);  //haber sayýsý
$to=ceil($total/$range);    // $range'e göre kaç tane haber sayfasý olacak ?

if($total<1){  //haber yoksa
  $page=temp_replace("module",$msg_file,$page);
  $page=temp_replace("msg",_lang_no_news,$page);
  $page=temp_replace("if_not_forward","",$page);
} #if

else{  //haber varsa
 $newsq=@db_query("select nid,header,content,sender,topic,editor,counter,time,image from ${dbprefix}news, ${dbprefix}news_topics where ${dbprefix}news.topic=${dbprefix}news_topics.tid and topic='$topic' and editor is not null order by nid desc limit $start,$range");
 //$pno*$range'den sonra $range kadar haber
 $out=write_news_content($newsq,1,0,$comment_on);  //haberi al
 $out.=page_nums($pno,$to,"?module=news&action=list_topics&topic=$topic",0);       // sayfa numaralandýrmasýný al
 $page=temp_replace("module",$out,$page);  //herþeyi yaz
} #else 
} #else
?>

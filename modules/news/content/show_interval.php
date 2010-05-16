<?
/*-------------------------
belli bir ay ve yýlý göster Mart 2005 gibi 
---------------------------*/
$month=(int)$_GET['m'];  //ayý al
$year=(int)$_GET['y'];  //yýlý al
if($_GET['d']) 
{$day=(int)$_GET['d'];
if($day<10) $day="0".$day;
if($month<10) $month="0".$month;
}
$pno=$_GET['pno'];  //sayfa numarasý
if(!$pno) $pno=1;  //öntanýmlý = 1

$numq=@db_query("select * from ${dbprefix}news_setup");
while($dt=db_fetch_row($numq)){ //haber özellikleri
  $range=$dt[0];    //sayfada en fazla kaç haber olsun
  $comment_on=$dt[1];
  $comment_type=$dt[2];
} #while

$start=($pno-1)*$range;  //mysql limit baþlangýcý
$totq=@db_query("select nid,header,content,sender,topic,editor,counter,time,image from ${dbprefix}news, ${dbprefix}news_topics where ${dbprefix}news.topic=${dbprefix}news_topics.tid and editor is not null and time like '%$year-%$month-%$day%' order by nid desc");
//haber sayýsýný al
$total=@db_num_rows($totq);  //haber sayýsý
$to=ceil($total/$range);    // $range'e göre kaç tane haber sayfasý olacak ?
if($total<1){  //haber yoksa
  $page=temp_replace("module",$msg_file,$page);
  $page=temp_replace("msg",_lang_no_news,$page);
  $page=temp_replace("if_not_forward","",$page);
} #if

else{  //haber varsa
 
 $newsq=@db_query("select nid,header,content,sender,topic,editor,counter,time,image from ${dbprefix}news, ${dbprefix}news_topics where ${dbprefix}news.topic=${dbprefix}news_topics.tid and editor is not null and time like '%$year-%$month-%$day%' order by nid desc limit $start,$range");
 //$pno*$range'den sonra $range kadar haber
 $out=write_news_content($newsq,"1","0",$comment_on);  //haberi al
 $out.=page_nums($pno,$to,"?module=news&action=show_interval&y=$year&m=$month&d=$day",0);      
 // sayfa numaralandýrmasýný al , url'i deðiþtir ve rss gösterme
 $page=temp_replace("module",$out,$page);  //herþeyi yaz
} #else

?>
<?
/*-------------------------
belli bir ay ve y�l� g�ster Mart 2005 gibi 
---------------------------*/
$month=(int)$_GET['m'];  //ay� al
$year=(int)$_GET['y'];  //y�l� al
if($_GET['d']) 
{$day=(int)$_GET['d'];
if($day<10) $day="0".$day;
if($month<10) $month="0".$month;
}
$pno=$_GET['pno'];  //sayfa numaras�
if(!$pno) $pno=1;  //�ntan�ml� = 1

$numq=@db_query("select * from ${dbprefix}news_setup");
while($dt=db_fetch_row($numq)){ //haber �zellikleri
  $range=$dt[0];    //sayfada en fazla ka� haber olsun
  $comment_on=$dt[1];
  $comment_type=$dt[2];
} #while

$start=($pno-1)*$range;  //mysql limit ba�lang�c�
$totq=@db_query("select nid,header,content,sender,topic,editor,counter,time,image from ${dbprefix}news, ${dbprefix}news_topics where ${dbprefix}news.topic=${dbprefix}news_topics.tid and editor is not null and time like '%$year-%$month-%$day%' order by nid desc");
//haber say�s�n� al
$total=@db_num_rows($totq);  //haber say�s�
$to=ceil($total/$range);    // $range'e g�re ka� tane haber sayfas� olacak ?
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
 // sayfa numaraland�rmas�n� al , url'i de�i�tir ve rss g�sterme
 $page=temp_replace("module",$out,$page);  //her�eyi yaz
} #else

?>
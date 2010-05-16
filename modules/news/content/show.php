<?
global $sitehost,$comment_on,$range;
$pno=$_GET['pno'];  //sayfa numarasý
if(!$pno) $pno=1;  // öntanýmlý = 1


$start=($pno-1)*$range;  //mysql limit baþlangýcý
$totq=@db_query("select nid,header,content,sender,topic,editor,counter,time,image from ${dbprefix}news, ${dbprefix}news_topics where ${dbprefix}news.topic=${dbprefix}news_topics.tid and editor is not null order by nid desc"); //kaç tane haber var
$total=@db_num_rows($totq);  //haber sayýsý
$to=ceil($total/$range);    // $range'e göre kaç tane haber sayfasý olacak ?

if($total<1){  //haber yoksa
  $page=temp_replace("module",$msg_file,$page);
  $page=temp_replace("msg",_lang_no_news,$page);
  $page=temp_replace("if_not_forward","",$page);
} #if

else{  //haber varsa
 $newsq=@db_query("select nid,header,content,sender,topic,editor,counter,time,image from ${dbprefix}news, ${dbprefix}news_topics where ${dbprefix}news.topic=${dbprefix}news_topics.tid and editor is not null order by nid desc limit $start,$range");
 //$pno*$range'den sonra $range kadar haber
$out=write_news_content($newsq,"1","0",$comment_on);  //haberi al
 $out.=page_nums($pno,$to);       // sayfa numaralandýrmasýný al
 $page=temp_replace("module",$out,$page);  //herþeyi yaz


global $news_headers; //arama motorlarý için haber baþlýklarýný anahtar kelime olarak gönder
$meta_keyword="<META name=\"KEYWORDS\" content=\"$news_keywords\">";

foreach ($news_headers as $keyword) {
$keyword=htmlspecialchars($keyword);
$ex=explode(" ",$keyword);
foreach ($ex as $outkey){
$output.=$outkey.", ";
}
}
$getlink=explode("?",$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
$sitehost="http://".$getlink[0];   //sitenin adresi

$output.=$sitehost;

$page=str_replace("<!--meta_command-->","<META name=\"KEYWORDS\" content=\"$output\"> \n <!--meta_command-->",$page);
} #else
?>
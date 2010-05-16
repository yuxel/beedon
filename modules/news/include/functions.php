<?
function list_topics($selected="1"){
  $dbprefix=$GLOBALS['dbprefix'];
  $topq=@db_query("select * from ${dbprefix}news_topics");
  $output="<select name=\"topic\">";
  while($data=@db_fetch_row($topq)){
    if($selected==$data[0]) $seltext="selected";
    else $seltext="";

    $output.="<option value=\"$data[0]\" $seltext>$data[2]";

  } #while

      $output.="</select>";
  return $output;
}  #list_topics   //konularý <select> tagi içinde listeler



function getRequiredPermEditNews(){ //haber düzenleme, silme gibi iþlemler için gerekli yetkiyi al
global $dbprefix;
$permQ=db_query("select * from ${dbprefix}administration where a_module='news'");
while($data=db_fetch_row($permQ)) return $data[1];
}


function getNumOfComments($nid){
global $dbprefix;

$commQ=db_query("select count(cid) from ${dbprefix}news_comments where newsid='$nid'");
while($data=db_fetch_row($commQ)) $returnFunc=$data[0];
if($returnFunc>0) return $returnFunc;
else return "0";
}



function writeComments($news_id){

global $news_comment_temp,$dbprefix;
$commentTemp=file_get_contents($news_comment_temp); //template'i  al ve deðiþkenleri deðiþtir bkz : template

$getComments=db_query("select * from ${dbprefix}news_comments where newsid='$news_id'");


while($data=db_fetch_row($getComments)){


$cid=$data[0];
$relatedComments[$cid]=$data[5];
$sfile="<br>".$commentTemp;
$sfile=temp_replace("user",$data[1],$sfile);
$sfile=temp_replace("header",$data[2],$sfile);
$sfile=temp_replace("comment",to_html($data[3]),$sfile);
$sfile=temp_replace("senddate",$data[6],$sfile);
$sfile=temp_replace("cid",$data[0],$sfile);
$sfile=temp_replace("nid",$news_id,$sfile);
$sfile=temp_replace("add_comment",_lang_add_comment,$sfile);
$returnx.=$sfile;


}

return $returnx;
}



function write_news_content($newsq,$split="1",$show_id="0",$comment_on="0")  //haber içeriðini yazar
{

global $news_start_temp,$news_show_id_temp,$news_comment_temp,$topics_image,$news_headers,$auth,$temp_dir,$getRequiredPermEditNews;
//$newsq = gelen sorgu
//$split = sayfa <!--split-->'e göre bölünsün mü bölünmesin mi deðiþkeni , 1 = bölünsün
//$show_id = sayfa ana template'e göre mi yazdýrýlsýn yoksa show_id templatine göre mi , 1 = show_id templateine göre
if($show_id=="1") $ntemp=$news_show_id_temp;  //eðer 1 ise show_id template'i
else $ntemp=$news_start_temp;	// deðilse start_temp

$getRequiredPermEditNews=getRequiredPermEditNews();

while($data=db_fetch_row($newsq)){
if($comment_on!="1"){
$commentText="";
$num_comments="";
$commentURL="";
}
else 
{
$commentText=_lang_comments;
$num_comments="(".getNumOfComments($data[0]).") |";
$commentURL="?module=news&amp;action=show_id&amp;id=$data[0]";

}
    $news_headers[].=$data[1];
    $st_file=@file_get_contents($ntemp); //template'i  al ve deðiþkenleri deðiþtir bkz : template
    $st_file=temp_replace("newsid",$data[0],$st_file);
    $st_file=temp_replace("header",$data[1],$st_file);
    $data[2]=str_replace("&lt;!--split--&gt;","<!--split-->",$data[2]);
    if(($split=="1") AND search_string("<!--split-->",$data[2])) {  //eðer split 1 ise
    $ncontent=explode("<!--split-->",$data[2]);   //eðer sayfa içinde <!--split--> var ise sadece buraya kadar olan kýsmý göster
    $writecontent=$ncontent[0]."<br><a href=\"?module=news&amp;action=show_id&amp;id=$data[0]\">"._lang_whole_text."</a>";
    }
    else $writecontent=$data[2];
    $st_file=temp_replace("news",to_html($writecontent),$st_file);
    $st_file=temp_replace("sender",_lang_sender,$st_file);
    if($data[3]!="beeman") $userWrote=str_replace("%user%","<a href=\"?module=users&amp;action=info&amp;user=$data[3]\">$data[3]</a>",_lang_user_wrote);
    else $userWrote=str_replace("%user%",_lang_anonymous,_lang_user_wrote);
    $st_file=temp_replace("user_wrote",$userWrote,$st_file);
    $st_file=temp_replace("date",_lang_date,$st_file);
    $exptime=explode(" ",$data[7]);
    $hour=$exptime[1];
    $expdate=explode("-",$exptime[0]);
    $year=$expdate[0];
    $month=$expdate[1];
    $day=$expdate[2];
    
    $dayname=return_dayname($year,$month,$day);
    $st_file=temp_replace("day",$day,$st_file);
    $st_file=temp_replace("month",$month,$st_file);
    $st_file=temp_replace("year",$year,$st_file);
    $st_file=temp_replace("hour",$hour,$st_file);
    $st_file=temp_replace("dayname",$dayname,$st_file);
    $st_file=temp_replace("comments",$commentText,$st_file);
    $st_file=temp_replace("num_comments",$num_comments,$st_file);
    $st_file=temp_replace("comment_url",$commentURL,$st_file);
    $st_file=temp_replace("month_name",return_month_name((int)$month),$st_file);
    $times_read=str_replace("%s",$data[6],_lang_times_read);
    $st_file=temp_replace("times_read",$times_read,$st_file);
    $st_file=temp_replace("topic_logo",$topics_image.$data[8],$st_file);
    $st_file=temp_replace("topic_url","?module=news&amp;action=list_topics&amp;topic=$data[4]",$st_file);
if($auth>=$getRequiredPermEditNews) {
$urlEdit="?module=admin&amp;a_module=news&amp;action=news&amp;effect=lookedit&amp;id=$data[0]";
$editDeleteText="&nbsp;<a  href=\"$urlEdit\"><img src=\"image/edit.png\" alt=\"\">"._lang_edit."/"._lang_delete."</a>";
}
else 
{
$editDeleteText="";
}
$st_file=temp_replace("edit_delete",$editDeleteText,$st_file);
$returnx.=$st_file."<br>";

if($comment_on=="1" AND $show_id=="1"){
//$returnx.=writeComments($data[0];

if($auth<2) {
$returnx.="#module#";
$mfile=file_get_contents("$temp_dir/msg.html");
$returnx=temp_replace("module",$mfile,$returnx);
$returnx=temp_replace("msg",_lang_no_access_to_comment,$returnx);
$returnx=temp_replace("if_not_forward",_lang_get_an_account_to_comment."<br><br><a href=\"?module=users\">"._lang_login."/"._lang_register,$returnx);
$returnx.=writeComments($data[0]);
} #auth
else {
$returnx.=writeComments($data[0]);
$returnx.="<center><a href=\"?module=news&amp;action=add_comment&amp;nid=$data[0]\">"._lang_add_comment."</a></center><br>";

}#elseauth


} #if comment_on and show_id
} #while



return $returnx;
}



function page_nums($pno,$to,$url="?module=news",$show_rss="1"){  //sayfa altýndaki sayfalamayý yap
  $url=htmlspecialchars($url); //html validation için
  global $temp_dir,$page;
  $up=$pno+1;
  $down=$pno-1;
  $lpage=file_get_contents("$temp_dir/list_pages.html");
  if($pno==$to) $lpage=temp_replace("right","",$lpage);
  else $lpage=temp_replace("right","<a href=\"${url}&amp;pno=$up\">&gt;</a>",$lpage);  //eðer sonraya gidelebeilcek sayfa varsa

  if($pno=="1") $lpage=temp_replace("left","",$lpage);
  else $lpage=temp_replace("left","<a href=\"${url}&amp;pno=$down\">&lt;</a>",$lpage);  //önceye gidilebilcek sayfa varsa

 for($i=1;$i<$to+1;$i++) {  //sayfa numaralarýný yaz
    if($i==$pno) $text="<b> $i </b>";
    else $text=" $i ";
    $pages.="<a href=\"${url}&amp;pno=$i\">$text</a>";
  }
  
  $lpage=temp_replace("pages",$pages,$lpage);
  //$lpage = sayfa sýralamasýnýn tümü 
  
  if($show_rss=="1"){ //eðer 1 ise
$rss_url="?module=news&amp;action=rss";


  $page=str_replace("<!--meta_command-->","<!--meta_command-->\n<link rel=\"alternate\" type=\"application/rss+xml\" title=\"$title\" href=\"$sitehost$rss_url\">",$page); //header'a rss olduðunu belirt
  
  $out.="<br>".$lpage."<br><div align=\"right\"><a href=\"$rss_url\" target=\"_blank\"><img src=\"image/rss.png\"alt=\"\"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>";  //rss simgesini göster
  }
  else $out.="<br>".$lpage."<br>";
  
  return $out;
  }



?>

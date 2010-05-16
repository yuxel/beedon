<?
global $dbprefix;

$how_many="10";
$queryNum=db_query("select * from ${dbprefix}news where editor is not null");
$num=db_num_rows($queryNum);
while($dt=db_fetch_row($queryNum)){
  $range=$dt[0];
} #while

$start=0;
$queryNews=db_query("select nid,header from ${dbprefix}news where editor is not null order by nid desc limit $start,$how_many");

$num=db_num_rows($queryNews);
if($num>0){
if($num>$how_many) $start=$num-$range;
$start=ceil($start/$how_many);

while($datax=mysql_fetch_row($queryNews)){
$btemp=file_get_contents("modules/news/template/blocks/oldnews.html");
$bout=temp_replace("header",$datax[1],$btemp);
$bout=temp_replace("id",$datax[0],$bout);
$out.=$bout;
} #while

$out.="<br><div align=\"center\"><a href=\"?module=news&amp;action=archive\">["._lang_archive."]</a></div>";
$block=temp_replace("content",$out,$block);
}
else
$block=temp_replace("content",_lang_no_news,$block);

?>
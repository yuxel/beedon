<?php
global $lang;
include "modules/news/lang/$lang.php";
function urlfromyearmonth($value){
$urlnow="http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
$checkurl=explode("?",$urlnow);

if(!$checkurl[1]) $addq="?";
else $addq="";

$expurl=explode("&cmonth=",$urlnow);

$exp=explode(" ",$value);
return htmlspecialchars($expurl[0])."$addq&amp;cmonth=$exp[1]&amp;cyear=$exp[0]";
}

if($_GET['cyear']) $cyear=$_GET['cyear']; else $cyear=date('Y');

if($_GET['cmonth']) $cmonth=$_GET['cmonth']; else $cmonth=date('m');

$highlight[]="0";
$getdates=db_query("select distinct(DATE_FORMAT(time,'%Y %m %d')) from ${dbprefix}news");
while($data=db_fetch_row($getdates)){
$expdt=explode(" ",$data[0]);
if(($expdt[1]==$cmonth) and ($expdt[0]==$cyear))
$highlight[]=$expdt[2];
}
if($_GET['day']) $day=$_GET['day']; else $day=date('d');

$dayname=dayname(date('l'));
$monthname=return_month_name($cmonth);


$calendar=file_get_contents("modules/news/template/blocks/calendar.html");

$calendar=temp_replace("month_name",$monthname,$calendar);
$calendar=temp_replace("year","$cyear",$calendar);

$startday_of_month=date("w",mktime(0,0,0,$cmonth,1,$cyear));
if($startday_of_month=="0") $startday_of_month=7;
else $startday_of_month=$startday_of_month;

$totaldaysofmonth=intval(date('t', mktime(12, 0, 0, $cmonth, 1, $cyear, 0)));

$cseven=1;
for($items=1;$items<$totaldaysofmonth+$startday_of_month;$items++){

if($cseven>=7) {$put_tr="</tr>\n<tr>";$cseven=0;}
else $put_tr="";

if($items<$startday_of_month) {$cseven++;$output.="<td></td>";}
else {
$daycount++;
if(in_array($daycount,$highlight)) $writedc="<a style=\"background-color:#B6B6B6;color:#FFFFFF\" href=\"?module=news&amp;action=show_interval&amp;y=$cyear&amp;m=$cmonth&amp;d=$daycount\">$daycount</a>";
else $writedc=$daycount;

$output.="<td>$writedc</td>$put_tr"; $cseven++;
}
}
$previous=date("Y m",mktime(0,0,0,$cmonth-1,$day,$cyear));
$next=date("Y m",mktime(0,0,0,$cmonth+1,$day,$cyear));

$calendar=temp_replace("next",urlfromyearmonth($next),$calendar);
$calendar=temp_replace("previous",urlfromyearmonth($previous),$calendar);
$calendar=temp_replace("items","$output",$calendar);

$calendar=temp_replace("mon",_lang_short_monday,$calendar);
$calendar=temp_replace("tue",_lang_short_tuesday,$calendar);
$calendar=temp_replace("wed",_lang_short_wednesday,$calendar);
$calendar=temp_replace("thur",_lang_short_thursday,$calendar);
$calendar=temp_replace("fri",_lang_short_friday,$calendar);
$calendar=temp_replace("sat",_lang_short_saturday,$calendar);
$calendar=temp_replace("sun",_lang_short_sunday,$calendar);

$block=temp_replace("content",$calendar,$block);

?> 

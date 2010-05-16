<?php
/*-------------------------
Fonksiyonlar
----------------------------*/



function connect_db($host,$user,$pass,$name){  //veritaban� ba�lant�s�
global $dbprefix,$connect_to_db,$select;
$connect_to_db=@mysql_connect($host,$user,$pass);
if(!isset($host) OR !isset($user)){
$errorPage=file_get_contents("template/errors/db_connection.html");
$page=temp_replace("messages","Config file not found",$errorPage);

$page=temp_replace("ERROR_MSG","MySQL Connection Error",$page);
$page=temp_replace("IF_NOT_FORWARD","Database problems, please try again later",$page);

echo $page;
exit;

}
else {


if(!$connect_to_db) {
$errorPage=file_get_contents("template/errors/db_connection.html");
$page=temp_replace("messages","Cannot connect to database",$errorPage);

$page=temp_replace("ERROR_MSG","MySQL Connection Error",$page);
$page=temp_replace("IF_NOT_FORWARD","Database problems, please try again later",$page);


echo $page;
exit;
}
$select=@mysql_select_db($name,$connect_to_db);
if(!$select) {
$errorPage=file_get_contents("template/errors/db_connection.html");
$page=temp_replace("messages","Database selection error",$errorPage);

$page=temp_replace("ERROR_MSG","MySQL Connection Error",$page);
$page=temp_replace("IF_NOT_FORWARD","Database problems, please try again later",$page);

echo $page;
exit;
}
$exists=0;
$searchForTable=@db_list_tables($name);

$search=$dbprefix."beedon";
while ($xrow = @db_fetch_row($searchForTable)) {
    if($xrow[0]==$search)
      $exists=1;
}

if($exists!=1){
$errorPage=file_get_contents("template/errors/db_connection.html");
$page=temp_replace("messages","Required table ".$dbprefix."beedon not fount<br>Check your installation or configuration",$errorPage);

$page=temp_replace("ERROR_MSG","MySQL Connection Error",$page);
$page=temp_replace("IF_NOT_FORWARD","Database problems, please try again later",$page);

echo $page;
exit;

}


} #else
return $connect_to_db;
} #connect_db

function close_db($connect_to_db){  //veritaban� ba�lant�s�n� kapat
global $connect_to_db;
return mysql_close($connect_to_db);
} #close_db


function db_query($query,$errorcontrol="1"){  //sql sorgusu
global $totalquery,$connect_to_db;
$totalquery++;
$result = mysql_query($query,$connect_to_db) ;
return $result;
if($errorcontrol=="1"){
if (!$result) {
echo mysql_error(); //mysql hatas�
echo $query; // hata veren sorgu
include "errors/db_connection.php"; //hata olunca a��lacak dosya
exit;
}
} #if error control
}



function db_drop_table($tablename){ //veritaban� kald�r
return db_query("drop table if exists $tablename");
}

function db_list_tables($name){ //tablolar� listele
global $connect_to_db;
return  mysql_list_tables($name,$connect_to_db);
}


function db_list_fields($dbname,$tableName){
global $connect_to_db;
return  mysql_list_fields($dbname,$tableName,$connect_to_db);

}

function db_field_name($db_list_fields,$index){
global $connect_to_db;
return mysql_field_name($db_list_fields,$index);

}



function db_num_fields($query){ //alanlar� listele
return  mysql_num_fields($query);
}

function db_fetch_row($query){  //sql'den row al
return mysql_fetch_row($query);
}
function db_num_rows($query){  //row say�s�n� al
return mysql_num_rows($query);
}


function get_date(){ // YIL-AY-GUN �eklinde tarih
    return date("Y-m-d");
}



function get_time(){ //SAAT:DAKIKA:SAN�YE �eklinde zaman
  return date("H:i:s",time()-date("Z"));
}

function forward ($url,$second,$page) {  //sayfa y�nlendir
  //theme dosyas� i�indeki "<!--meta_command-->" �zel tag'ini de�i�tirir
  $url=str_replace("&","&amp;",$url); //html validation i�in
  $page=str_replace("<!--meta_command-->","<!--meta_command-->\n<meta http-equiv=\"refresh\" content=\"$second;url=$url\">",$page);
  return $page;
} # forward

function return_lang_name($var){  //dil koduna g�re dilin tam ad�n� d�nd�r
  $languages = array("tr" => "T�rk�e","en" => "English", "de" => "Deutsch");
  return $languages[$var];
} #return_lang_name

function return_charset($var){ //dil koduna uygun karakter setini d�nd�r
  $languages = array("tr" => "iso-8859-9","en" => "utf-8", "de" => "iso-8859-1");
  return $languages[$var];
} # return_charset

function temp_replace($var,$content,$page){  //tema i�indeki # karakterleri aras�ndaki kelimeleri de�i�tir
  return str_replace("#$var#",$content,$page);
} #temp_replace


function list_languages($path,$selected,$submit,$action){
  $return="\n<form action=\"$action\" method=\"post\">\n";
  $return=$return.select_languages($path,$selected,$submit);
  $return=$return."<br><br><input type=\"submit\" value=\""._lang_install_submit."\"></form>\n";
  return $return;
}

function enc_pass($sifre){ //�ifre veritaban�n ilk 15 karakteri olarak tutuluyor
  return substr(md5($sifre),0,15);
} # enc_pass

function select_languages($path,$selected,$submit){ 
//$path dizini i�indeki lang klas�r�lerindeki dosyalar�, dil koduna uygun �ekilde
//combobox i�inde listeler
//$selected ile gelen veri e�er varsa combox'da se�ili halde olur
//$submit 1 ise onclick=submit javascript kodu aktifle�tirilir
  if($submit==1) $submitword="onclick=\"submit()\"";
  else $submitword="";
  $path=$path."/lang";
  $return="\n<select $submitword name=\"lang\">\n";
  $klasor = @opendir($path);
  while ($dosya = readdir($klasor)) {
    if($dosya == "." || $dosya == ".." || $dosya == "index.php" || $dosya == "index.html")  // .. , . ve index.php listelenmesin
      continue;
    $bol = explode(".", $dosya);
    if($bol[0]==$selected) $msg="selected";
    else $msg="";
    $return=$return."<option $msg value=\"$bol[0]\">".return_lang_name($bol[0])."\n";
  }

  $return=$return."</select>\n";
  closedir($klasor);
  return $return;
}




function select_theme($path,$selected="default"){  
//$path i�indeki tema dizini i�indeki temalar� listeler
//$selected gibi bir tema varsa, bu tema se�ilir
  $path=$path."/theme";
  $return="\n<select name=\"theme\">\n";
  $klasor = @opendir($path);
  while ($dosya = readdir($klasor)) {
    if($dosya == "." || $dosya == ".." || $dosya == "index.php" || $dosya == "index.html")  // .. , . ve index.php listelenmesin
      continue;
    $bol = explode(".", $dosya);
    if($bol[0]==$selected) $msg="selected";
    else $msg="";
    $return=$return."<option $msg value=\"$bol[0]\">".$dosya."\n";
  }
  $return=$return."</select>\n";
  closedir($klasor);
  return $return;
}

function list_avatars($selected,$path="image/avatar"){  
	//$path i�indeki avatarlar� listeler
	  if($selected=="") $selected="default.png";
  $return="<img src=\"$path/$selected\" alt=\"$selected\"><br>".popup("modules/users/content/list_avatars.php",_lang_list)."\n<select name=\"avatar\">\n";
  $klasor = @opendir($path);
  while ($dosya = readdir($klasor)) {
    if($dosya == "." || $dosya == ".." || $dosya == "index.php" || $dosya == "index.html")  // .. , . ve index.php listelenmesin
      continue;
    if($dosya==$selected) $msg="selected";
    else $msg="";
    $return=$return."<option $msg value=\"$dosya\">".$dosya."\n";
  }
  $return=$return."</select>\n";
  closedir($klasor);
  return $return;
}

function popup($url,$prompt="click",$width=450,$height=250){  //verilen boyutlarda popup ��kar�r
  return "<A HREF=\"#\" onclick=\"window.open('$url','','toolbar=no,scrollbars=n o,resizable=no,width=$width,height=$height');\">$prompt</A>";
}


function list_auths($nauth="1",$click="0",$range=4){  //yetkileri ve de�erlerini s�ralar
//4 y�netici
//3 editor
//2 kay�tl� kullan�c�
//1 ziyaretci
  if($click=="1") $cmsg="onclick=\"submit()\"";
  else $cmsg="";
  $auths=array("4"=>_lang_admin,"3"=>_lang_editor,"2"=>_lang_normal_user,"1"=>_lang_null_user);
  $return="\n<select $cmsg name=\"nauth\">\n";
  $to=4-$range;

  for($i=4;$i>$to;$i--) {
    if($nauth==$i) $select_msg="selected";
    else $select_msg="";
    $return.="<option $select_msg value=\"$i\">".$auths[$i];
  }
  $return.="</select>";
  return $return;
} #list_auths



function to_html($xyz,$preview="0") {  //text girdilerinde html yasaklanm��t�r
//ancak belli tag'ler belli �ekillerde kullan�labilir
//�rn: <b>kal�n yaz�</b> gibi bir girdi girerseniz bu veritaban�na
//&lt;kal�n yaz�&gt; gibi tag'lerle yaz�lacakt�r
//ancak [b]kal�n yaz�[/b] olarak yazarsan�z
//yaz� veritaban�na <b>kal�n yaz�</b> olarak saklanacakt�r

  $xyz=str_replace("\\","\\\\",$xyz);
if($preview=="1") $xyz=stripslashes($xyz);
  
  $xyz=str_replace("[b]", "<b>", $xyz);
  $xyz=str_replace("[/b]", "</b>", $xyz);
  $xyz=str_replace("[i]", "<i>", $xyz);
  $xyz=str_replace("[/i]", "</i>", $xyz);
  $xyz=str_replace("[u]", "<u>", $xyz);
  $xyz=str_replace("[/u]", "</u>", $xyz);
  
  $match = array('#\[code\](.*?)\[\/code\]#se');
  $replace = array("'<blockquote class=\"code\">'.highlight_string(stripslashes(html_entity_decode('$1')), true).'</blockquote>'");
  $xyz=preg_replace($match, $replace, $xyz);
  //$xyz= eregi_replace("\\[code]([^\"]*)\\[\\/code\\]","<blockquote><pre class=\"code\">\\1</pre></blockquote>",$xyz);
  //$xyz= eregi_replace("\\[code]([^\"]*)\\[\\/code\\]","<blockquote><pre class=\"code\">\\1</pre></blockquote>",$xyz);
  $xyz = eregi_replace("(^|[ \n\r\t])((http(s?)://)(www\.)?([a-z0-9_-]+(\.[a-z0-9_-]+)+)(/[^/ \n\r]*)*)","\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $xyz);
  $xyz = eregi_replace("(^|[ \n\r\t])(www\.([a-z0-9_-]+(\.[a-z0-9_-]+)+)(/[^/ \n\r]*)*)","\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $xyz);
  $xyz = eregi_replace("\\[img]([^\\[]*)\\[\\/img\\]","<img src=\"\\1\" alt=\"\\1\">",$xyz);
  $xyz = eregi_replace("\\[url=([^\\[]*)\\]([^\\[]*)\\[\\/url\\]","<a href=\"\\1\" target=\"_blank\">\\2</a>",$xyz);
  //$xyz = str_replace("&lt;!--split--&gt;","<!--split-->",$xyz);
  $xyz=str_replace("\n", "<br>", $xyz);
  $xyz=str_replace(htmlspecialchars("<!--split-->"), "<!--split-->", $xyz);
  return $xyz;
  
  highlight_string("echo foo;",true);
}

function from_html($xyz){  
    //text alan�nda okunan html tag'leri eski hallerine �evrilir
    //sayfada <b> gibi bir tag varsa bunu [b] olarak �evirir
    //bu �imdilik eski s�r�m deste�i i�in
    //yeni d�zenlemelerden sonra bu i�te yaramayacak
    
  $xyz=str_replace("<br>", "\n", $xyz);
  $xyz=str_replace("<b>","[b]", $xyz);
  $xyz=str_replace("</b>","[/b]", $xyz);
  $xyz=str_replace("<i>","[i]", $xyz);
  $xyz=str_replace("</i>","[/i]",  $xyz);
  $xyz=str_replace("<u>", "[u]",  $xyz);
  $xyz=str_replace("</u>", "[/u]",  $xyz);
  $xyz = eregi_replace("<img src=\"([^\"]*)\\\" alt=\"([^\"]*)\\\">","[img]\\1[/img]",$xyz);
  $xyz = eregi_replace("<a href=\"([^\"]*)\">([^\"]*)\\</a>","[url=\\1]\\2[/url]",$xyz);
  $xyz = eregi_replace("<a href=\"([^\"]*)\" target=\"_blank\">([^\"]*)\\</a>","[url=\\1]\\2[/url]",$xyz);
  $xyz = eregi_replace("<blockquote><pre class=\"code\">([^\"]*)\\</pre></blockquote>","[code]\\1[/code]",$xyz);
  
  return $xyz;
} 



function upload_dialog($action,$name){  //dosya y�kleme kutusu
  $out.="<div align=\"center\">";
  $out.="<FORM enctype=\"multipart/form-data\" action=\"$action\" method=\"post\">";
  $out.="<input type=\"file\" name=\"$name\"><br><br>";
  $out.="<input type=\"submit\">";
  $out.="</FORM>";
  $out.="</div>";
  return $out;
} #upload_dialog

function select_image($path,$selected){  //$path i�indeki resimleri listeler
  $return="<select name=\"image\">";
  $klasor = @opendir($path);
  while ($dosya = readdir($klasor)) {
    if($dosya == "." || $dosya == ".." || $dosya == "index.php" || $dosya == "index.html")  // .. , . ve index.php listelenmesin
      continue;
    if($dosya==$selected) $msg="selected";
    else $msg="";
    $return=$return."<option $msg value=\"$dosya\">".$dosya."\n";
  }

  $return=$return."</select>\n";
  closedir($klasor);
  return $return;
}

function return_dayname($year,$month,$day){  //gg�n de�eri d�nd�r�r
  $days=array("Monday"=>_lang_monday,
	      "Tuesday"=>_lang_tuesday,
	      "Wednesday"=>_lang_wednesday,
	      "Thursday"=>_lang_thursday,
	      "Friday"=>_lang_friday,
	      "Saturday"=>_lang_saturday,
	      "Sunday"=>_lang_sunday);
  return $days[date("l", mktime(0, 0, 0, $month, $day, $year))];
}


function return_month_name($num){  //1 gibi bir girdiyi Ocak olarak d�nd�r�r
$num=(int)$num;
$months=array(
	      "1"=>_lang_january,
	      "2"=>_lang_february,
	      "3"=>_lang_march,
	      "4"=>_lang_april,
	      "5"=>_lang_may,
	      "6"=>_lang_june,
	      "7"=>_lang_july,
	      "8"=>_lang_august,
	      "9"=>_lang_september,
	      "10"=>_lang_october,
	      "11"=>_lang_november,
	      "12"=>_lang_december,
	      );
return $months[$num];
}


function dayname($name){  //g�n de�erlerini d�nd�r�r�
  $days=array("Monday"=>_lang_monday,
	      "Tuesday"=>_lang_tuesday,
	      "Wednesday"=>_lang_wednesday,
	      "Thursday"=>_lang_thursday,
	      "Friday"=>_lang_friday,
	      "Saturday"=>_lang_saturday,
	      "Sunday"=>_lang_sunday);
  return $days[$name];
}


function search_string($search,$string){  //$string i�inde $search arar
return preg_match("/$search/", $string);
} //search_string

?>

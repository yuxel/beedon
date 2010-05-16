<?
/*---------------------------
�statistik fonksiyonlar� ve bilgilerin veritaban�na giri�i
------------------------------*/

function get_user_os(){
  // kullan�c�n�n i�letim sisteminin tespiti
  $data=" ".strtolower($_SERVER['HTTP_USER_AGENT']);
  if (strpos($data, "win")!=false) $os="windows";
  else if (strpos($data, "microsoft")!=false) $os="windows";
  else if (strpos($data, "lynx")!=false) $os="nix";
  else if (strpos($data, "w3m")!=false) $os="nix";
  else if (strpos($data, "nix")!=false) $os="nix";
  else if (strpos($data, "linux")!=false) $os="nix";
  else if (strpos($data, "x11")!=false) $os="nix";
  else if (strpos($data, "sunos")!=false) $os="nix";
  else if (strpos($data, "bsd")!=false) $os="nix";
  else if (strpos($data, "os/2")!=false) $os="os2";
  else if (strpos($data, "mac")!=false) $os="mac";
  else if (strpos($data, "beos")!=false) $os="beos";
  else $os="other";
  return $os;
} #get_os

function get_user_browser(){
  // kullan�c�n�n taray�c�s�n�n tespiti
  $data=" ".strtolower($_SERVER['HTTP_USER_AGENT']);
  if (strpos($data, "mozilla")!=false) $browser="mozilla";
  else if (strpos($data, "gecko")!=false) $browser="mozilla";
  else if (strpos($data, "msie")!=false) $browser="ie";
  else if (strpos($data, "opera")!=false) $browser="opera";
  else if (strpos($data, "konq")!=false) $browser="konqueror";
  else if (strpos($data, "safari")!=false) $browser="safari";
  else $browser="other";
  return $browser;
} #get_browser

function write_stats_to_db(){  //bilgileri veritban�na yazma
$nick=$GLOBALS['bee_name'];
$ip=$_SERVER['REMOTE_ADDR'];
$os=get_user_os();
$browser=get_user_browser();
$exppage=explode("?",$_SERVER["REQUEST_URI"]);
$spage=end($exppage);
$time=get_date()." ".get_time();
$sessionid=substr(session_id(),0,20);

if(!preg_match("/modul([a-zA-Z0-9_-])+/", $spage)) $spage="module=home";

//echo $nick."<br>".$ip."<br>".$os."<br>".$browser."<br>".$spage."<br>".$time."<br>".$sessionid;
global $dbprefix;
@db_query("insert into ${dbprefix}stats (nick,ip,os,browser,page,time,sessionid) values('$nick','$ip','$os','$browser','$spage','$time','$sessionid')");
}

write_stats_to_db();  //bilgileri yaz


//Online kullan�c�lar� ve kullan�c� say�s�n� al 
//Son iki dakika i�indeki olaylar� yaz�yor
//$countmembers online kullan�c� say�s�
//$countvisitor online ziyaretci say�s�
//$onlinemembers[]  kay�tl� kullan�c�lar�n nicklerinin oldu�u array
$countmembers=0;
$countvisitor=0;
$user_block=file_get_contents("modules/stats/template/blocks/block.html");
$curdate=get_date();
$curtime=get_time();
$expdate=explode("-",$curdate);
$myyear=$expdate[0];
$mymonth=$expdate[1];
$myday=$expdate[2];
$exptime=explode(":",$curtime);
$myhour=$exptime[0];
$myminute=$exptime[1];
$mynow=mktime($myhour,$myminute,0,$mymonth,$myday,$myyear);
$now=date("Y-m-d H:i",$mynow);
$oneminbefore=date("Y-m-d H:i",$mynow-60);
global $countvisitor,$countmembers,$onlinemembers;

$onlines=db_query("select distinct(sessionid),nick from ${dbprefix}stats where time like '$now%' or time like '$oneminbefore%' group by sessionid");
while($datax=db_fetch_row($onlines)){
if($datax[1]=="beeman") {  //e�er kullan�c� beeman (beedondaki ziyaretci i�in tan�mlama) ise ziyaretci say�s�n� bir artt�r
$countvisitor++;
} #if
else {  //de�ilse kullan�c� say�s�n� artt�r ve kullan�c� ad�n� array'a yaz
$countmembers++;
$onlinemembers[$countmembers]=$datax[1];
} #else
}
?>
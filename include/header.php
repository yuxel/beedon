<?
/*------------------------
baþlangýç olaylarý
-------------------------*/


connect_db($dbhost,$dbuser,$dbpass,$dbname);  //veritabanýna baðlan

global $lang,$dbprefix,$bee_name,$bee_pass_hash;

$getuser=@db_query("select mail,auth,theme,language from ${dbprefix}members where nick='$bee_name' and password='$bee_pass_hash' and is_active='1'");  //kullanýcý bilgilerini al
  while($data=@db_fetch_row($getuser)){
$mail=$data[0];  //eposta
$auth=$data[1];  //yekli
$theme=$data[2]; //tema
$lang=$data[3];  //dil
  }

$getsite=@db_query("select slogan,charset,title,footer from ${dbprefix}beedon"); //sayfa bilgileri al
while($datas=@db_fetch_row($getsite)){
$slogan=$datas[0];  //slogan
$charset=$datas[1];  //karakter seti
$title=$datas[2];  //baþlýk
$footer=$datas[3];  //alt mesaj
}


$getlink=explode("?",$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
$sitehost="http://".$getlink[0];   //sitenin adresi
  
$theme_dir="theme/$theme"; //tema klasörü
if(!file_exists("$theme_dir/index.php")) {  //eðer kullanýcý temasý bu
  $theme="default";  //yoksa default
}

include "lang/$lang.php";  //dil deðiþkenlerini yükle
include "theme/$theme/index.php";  //temayý yükle

?>
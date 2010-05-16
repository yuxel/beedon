<?
/*--------------------
Beedon kurulum programý
----------------------*/
session_start();
global $writeprefix,$lang;
$back=$_SERVER['HTTP_REFERER'];  //geri dönüþ için
include "../include/functions.php";

$image_dir="../image/";

$lang=$_POST['lang'];
$module=str_replace("/","",$_GET['module']);  // dýþardan birisi klasör arasý gezemesin


$writeprefix=substr(session_id(),0,5);
//dosyalar geçici olarak install dizini altýnda tmp/ klasörüne yazýlacak, dosyalara prefix olarak session_id'nin ilk 5 karakteri belirleniyor

$langfile="tmp/$writeprefix"."_lang.php";
$dbfile="tmp/$writeprefix"."_db.php";
$adminfile="tmp/$writeprefix"."_admin.php";
$sitefile="tmp/$writeprefix"."_site.php";
$mainconfig="../config/config.php";
$mainconfig_dir="../config/";
$tmp_dir="tmp/";



if(!$_POST['lang']) //öntanýmlý dil = tr
{
  if(file_exists($langfile)) include $langfile;
  else $lang="tr";
  
}

if(!$module) $module="info";  //öntanýmlý modül = info


include "lang/$lang.php";  //kurulum dil dosyasýný çaðýr
include "../lang/$lang.php"; // ana dil dosyasý





$charset=return_charset($lang); //functions.php
$title=_lang_install_title;    
// _lang'lar dil deðiþkenleri için $lang.php'den alýnanlar
$page=file_get_contents("template/start.html"); 
//beedon template için belgelendirmedeki 'template' bölümüne bakýn



$page=temp_replace("charset",$charset,$page);
$page=temp_replace("title",$title,$page);
$page=temp_replace("about",_lang_install_about,$page);



$module_content=file_get_contents("template/$module.html"); 
// her $modul  deðiþkenie göre ekrana template klasöründen modul_adý.html dosyasýný yazdýr
$page=temp_replace("module",$module_content,$page);
if(file_exists("module/$module.php")) include "module/$module.php";  //eðer dosya varsa include et

$page=temp_replace("img_dir",$image_dir,$page);
echo $page;

?>
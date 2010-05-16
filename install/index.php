<?
/*--------------------
Beedon kurulum program�
----------------------*/
session_start();
global $writeprefix,$lang;
$back=$_SERVER['HTTP_REFERER'];  //geri d�n�� i�in
include "../include/functions.php";

$image_dir="../image/";

$lang=$_POST['lang'];
$module=str_replace("/","",$_GET['module']);  // d��ardan birisi klas�r aras� gezemesin


$writeprefix=substr(session_id(),0,5);
//dosyalar ge�ici olarak install dizini alt�nda tmp/ klas�r�ne yaz�lacak, dosyalara prefix olarak session_id'nin ilk 5 karakteri belirleniyor

$langfile="tmp/$writeprefix"."_lang.php";
$dbfile="tmp/$writeprefix"."_db.php";
$adminfile="tmp/$writeprefix"."_admin.php";
$sitefile="tmp/$writeprefix"."_site.php";
$mainconfig="../config/config.php";
$mainconfig_dir="../config/";
$tmp_dir="tmp/";



if(!$_POST['lang']) //�ntan�ml� dil = tr
{
  if(file_exists($langfile)) include $langfile;
  else $lang="tr";
  
}

if(!$module) $module="info";  //�ntan�ml� mod�l = info


include "lang/$lang.php";  //kurulum dil dosyas�n� �a��r
include "../lang/$lang.php"; // ana dil dosyas�





$charset=return_charset($lang); //functions.php
$title=_lang_install_title;    
// _lang'lar dil de�i�kenleri i�in $lang.php'den al�nanlar
$page=file_get_contents("template/start.html"); 
//beedon template i�in belgelendirmedeki 'template' b�l�m�ne bak�n



$page=temp_replace("charset",$charset,$page);
$page=temp_replace("title",$title,$page);
$page=temp_replace("about",_lang_install_about,$page);



$module_content=file_get_contents("template/$module.html"); 
// her $modul  de�i�kenie g�re ekrana template klas�r�nden modul_ad�.html dosyas�n� yazd�r
$page=temp_replace("module",$module_content,$page);
if(file_exists("module/$module.php")) include "module/$module.php";  //e�er dosya varsa include et

$page=temp_replace("img_dir",$image_dir,$page);
echo $page;

?>
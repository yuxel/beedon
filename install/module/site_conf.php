<?
/*--------------------
Kontrolleri yapýp yönetici ayarlarýný dosyaya yaz.
Site yapýlandýrmasýný ekrana yazdýr
-------------------------------*/

if(search_string("module=dbcheck",$back))  //sayfaya diret eriþim izni verilmesin
{ //eðer direkt eriþim yoksa

  include "../include/controls.php";  //controls.php


  if(file_exists($adminfile)) include $adminfile; //önceden varsa al

  //deðiþkenleri al
  $adminnick=htmlspecialchars($_POST['adminnick']);
  $adminmail=htmlspecialchars($_POST['adminmail']);
  $adminpass=htmlspecialchars($_POST['adminpass']);
  $adminpass2=htmlspecialchars($_POST['adminpass2']);


  $errormsg="";
  $errors=0;


  if(nicklength($adminnick)){  // ../include/controls.php
    $errormsg=$errormsg.nicklength($adminnick)."<br>";
    $errors++;
  }  //eðer nick ../include/controls.php de belirtilenden kýsa ise

  if(passlength($adminpass)){ // ../include/controls.php
    $errormsg=$errormsg.passlength($adminpass)."<br>";
    $errors++;
  } // þifre ../include/controls.php de belirtilenden kýsa ise

  if(email_control($adminmail)){ // ../include/controls.php
    $errormsg=$errormsg.email_control($adminmail)."<br>";
    $errors++;
  } //eðer geçersiz bir eposta adresi ise

  if(pass_not_same($adminpass,$adminpass2)){ // ../include/controls.php
    $errormsg=$errormsg.pass_not_same($adminpass,$adminpass2)."<br>";
    $errors++;
  }  // girilen þifreler uyuþmuyorsa

  if($errors!=0){ 
    //hata varsa 
    // bkz : template
    $goto=file_get_contents("template/admin_errors.html");
    $page=temp_replace("module",$goto,$page);
    $page=temp_replace("errormsg",$errormsg,$page);
    $page=temp_replace("if_not_forward",_lang_install_if_not_forward." <a href=\"$back\">"._lang_install_click_here."</a>",$page);
    $page=forward($back,2,$page);
  }
  else
    {
      $pass_hash=enc_pass($adminpass);  // ../include/functions.php
      $yazilacak= $adminfile;
      // yönetici bilgilerini $adminfile'a yaz
      $fp = fopen ($yazilacak,"w");
      fwrite ($fp,"<?
//Yönetici ayarlari 
\$adminnick=\"$adminnick\";
\$adminmail=\"$adminmail\";
\$adminpass=\"$pass_hash\";
//--------------- 
?>");
  
      fclose ($fp);
      $goto=file_get_contents("template/site_conf2.html");
      $page=temp_replace("module",$goto,$page);
      $page=temp_replace("site_header",_lang_install_site_header,$page);
      $page=temp_replace("info_text",_lang_install_info_site_conf,$page);
      $page=temp_replace("title",_lang_title,$page);
      $page=temp_replace("allowed_tags",_lang_allowed_tags,$page);
      $page=temp_replace("slogan",_lang_install_slogan,$page);
      $page=temp_replace("footer",_lang_install_footer,$page);
      $page=temp_replace("charset",_lang_install_charset,$page);
      $page=temp_replace("select_charsets",return_charset($lang),$page); //functions.php
      $page=temp_replace("startdate",_lang_install_startdate,$page);
      $page=temp_replace("date",get_date(),$page);   //functions.php
      $page=temp_replace("default_theme",_lang_install_default_theme,$page);
      $page=temp_replace("default_language",_lang_install_default_language,$page);
      $page=temp_replace("select_themes",select_theme("../"),$page); //functions.php
      $page=temp_replace("select_languages",select_languages("../",$lang,"0"),$page); //functions.php
      $default_footer=from_html(_lang_install_default_footer);  //functions.php
      $page=temp_replace("default_footer",$default_footer,$page);
      $page=temp_replace("submit_text",_lang_install_submit,$page);
    }
} #if || referer check
else { //eðer direkt eriþim varsa
  echo "<div align=\"center\">"._lang_you_cannot_access_directly."</div>";
  exit;
}

?>
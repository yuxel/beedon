<?
/*---------------
Kurulum giriþ sayfasý ve yazýlabilirlik kontrolleri
------------------*/


include_once $mainconfig_dir."version.php";
//aþaðýda index.php'de çaðýrýlan template üstünde deðiþiklik yapýlýyor
//temp_replace() için belgelerdeki "template" bölümüne bakýn
$page=temp_replace("WELCOME",_lang_install_welcome,$page);
$page=temp_replace("VERSION_INFO",_lang_install_version." : ".$beedon_version."<br>"._lang_install_release_date." :".$beedon_release_date,$page);
$page=temp_replace("INFO_TEXT",_lang_install_info,$page);
$page=temp_replace("WRITE_INFO",_lang_install_write_info,$page);
$page=temp_replace("CONFIG_FILE",_lang_install_config_file." : ".$mainconfig,$page);
$page=temp_replace("TMP_DIR",_lang_install_tmp_dir." : install/".$tmp_dir,$page);
//
if (!is_writable("$mainconfig_dir")) $write_error=1; //ayar dosyasýnýn yazýlabilirdliði 
elseif((file_exists("$mainconfig")) AND (!is_writeable("$mainconfig"))) $write_error=2;
else $write_error=0;

if(!is_writeable($tmp_dir)) $tmp_write_error=1;  // kurulum geçici klasörünün yazýlabilirliði
else $tmp_write_error=0;
//
if(($tmp_write_error==0) AND ($write_error==0)) {  //eðer yazýlabilirse
  $page=temp_replace("WRITE_RETRY","",$page);
  $page=temp_replace("LANG_INFO",_lang_install_lang_info,$page);
  $page=temp_replace("LANG_SELECT",list_languages(".",$lang,"1","?module=db"),$page);
}
else{
  $page=temp_replace("WRITE_RETRY","<a href=\"?module=$module\">"._lang_install_retry."</a>",$page);
}

switch ($write_error){ //eðer yazýlabilir ise
 case "0" : {
   $page=temp_replace("WRITEABLE",_lang_install_writeable,$page);  
   
 }
   
 case "1": { //eðer klasöre yazýlamaz ise
   $page=temp_replace("WRITEABLE",_lang_install_write_error1,$page); 
   $page=temp_replace("LANG_INFO","",$page);
   $page=temp_replace("LANG_SELECT","",$page);break;
 }
 case "2":{ //eðer dosyaya yazýlmaz ise
   
   $page=temp_replace("LANG_INFO","",$page);  
   $page=temp_replace("LANG_SELECT","",$page);
   $page=temp_replace("WRITEABLE",_lang_install_write_error2,$page);break;
 }
   
   
} //switch write error


switch($tmp_write_error){ //geçici klasöre yazýlamaz ise
 case "1" : {
   $page=temp_replace("TMP_WRITEABLE",_lang_install_tmp_write_error,$page);  
 }
 case "0" : {  //geçici klasöre yazýlabilir ise
   $page=temp_replace("TMP_WRITEABLE",_lang_install_tmp_write_success,$page);
 }
} //switch tmp_write_error

?>
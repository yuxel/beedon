<?
/*---------------
Kurulum giri� sayfas� ve yaz�labilirlik kontrolleri
------------------*/


include_once $mainconfig_dir."version.php";
//a�a��da index.php'de �a��r�lan template �st�nde de�i�iklik yap�l�yor
//temp_replace() i�in belgelerdeki "template" b�l�m�ne bak�n
$page=temp_replace("WELCOME",_lang_install_welcome,$page);
$page=temp_replace("VERSION_INFO",_lang_install_version." : ".$beedon_version."<br>"._lang_install_release_date." :".$beedon_release_date,$page);
$page=temp_replace("INFO_TEXT",_lang_install_info,$page);
$page=temp_replace("WRITE_INFO",_lang_install_write_info,$page);
$page=temp_replace("CONFIG_FILE",_lang_install_config_file." : ".$mainconfig,$page);
$page=temp_replace("TMP_DIR",_lang_install_tmp_dir." : install/".$tmp_dir,$page);
//
if (!is_writable("$mainconfig_dir")) $write_error=1; //ayar dosyas�n�n yaz�labilirdli�i 
elseif((file_exists("$mainconfig")) AND (!is_writeable("$mainconfig"))) $write_error=2;
else $write_error=0;

if(!is_writeable($tmp_dir)) $tmp_write_error=1;  // kurulum ge�ici klas�r�n�n yaz�labilirli�i
else $tmp_write_error=0;
//
if(($tmp_write_error==0) AND ($write_error==0)) {  //e�er yaz�labilirse
  $page=temp_replace("WRITE_RETRY","",$page);
  $page=temp_replace("LANG_INFO",_lang_install_lang_info,$page);
  $page=temp_replace("LANG_SELECT",list_languages(".",$lang,"1","?module=db"),$page);
}
else{
  $page=temp_replace("WRITE_RETRY","<a href=\"?module=$module\">"._lang_install_retry."</a>",$page);
}

switch ($write_error){ //e�er yaz�labilir ise
 case "0" : {
   $page=temp_replace("WRITEABLE",_lang_install_writeable,$page);  
   
 }
   
 case "1": { //e�er klas�re yaz�lamaz ise
   $page=temp_replace("WRITEABLE",_lang_install_write_error1,$page); 
   $page=temp_replace("LANG_INFO","",$page);
   $page=temp_replace("LANG_SELECT","",$page);break;
 }
 case "2":{ //e�er dosyaya yaz�lmaz ise
   
   $page=temp_replace("LANG_INFO","",$page);  
   $page=temp_replace("LANG_SELECT","",$page);
   $page=temp_replace("WRITEABLE",_lang_install_write_error2,$page);break;
 }
   
   
} //switch write error


switch($tmp_write_error){ //ge�ici klas�re yaz�lamaz ise
 case "1" : {
   $page=temp_replace("TMP_WRITEABLE",_lang_install_tmp_write_error,$page);  
 }
 case "0" : {  //ge�ici klas�re yaz�labilir ise
   $page=temp_replace("TMP_WRITEABLE",_lang_install_tmp_write_success,$page);
 }
} //switch tmp_write_error

?>
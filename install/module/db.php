<?
/*-------------------
Dil de�i�kenini yaz ve
---------------------*/

$yazilacak= $langfile; // index.php'deki $langfile'a dili yaz
$fp = fopen ($yazilacak,"w");
fwrite ($fp,"<?
//Veri tabani ayarlari 
\$lang=\"$lang\";
//--------------- 
?>");


// ekrana veritaban� bilgileri girilmesi i�in g�r�nt�leri ��kar
// belgelerde 'template'e bak�n
$page=temp_replace("DB_HEADER",_lang_install_db_header,$page);
$page=temp_replace("INFO_TEXT",_lang_install_info_text , $page);
$page=temp_replace("HOST",_lang_install_host , $page);
$page=temp_replace("DB_NAME",_lang_install_db_name , $page);
$page=temp_replace("USER_NAME",_lang_install_user_name , $page);
$page=temp_replace("USER_PASS",_lang_install_user_pass , $page);
$page=temp_replace("PREFIX",_lang_install_prefix , $page);
$page=temp_replace("SUBMIT_TEXT",_lang_install_submit , $page);
?>
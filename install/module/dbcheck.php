<?
/*-------------------------------
veritaban� ba�lant� kontrol� ve y�netici yap�land�rmas�
------------------------------------*/

if(search_string("module=db",$back))  //sayfaya diret eri�im izni verilmesin
{ //e�er direkt eri�im yoksa
  // de�i�kenleri al
  $dbhost=htmlspecialchars($_POST['dbhost']);
  $dbname=htmlspecialchars($_POST['dbname']);
  $dbuser=htmlspecialchars($_POST['dbuser']);
  $dbpass=htmlspecialchars($_POST['dbpass']);
  $dbprefix=htmlspecialchars($_POST['dbprefix']);

  @mysql_connect($dbhost,$dbuser,$dbpass,$dbname);
  
  $search=$dbprefix."beedon";
  $result = @mysql_list_tables($dbname);

  while ($row = @mysql_fetch_row($result)) {
    if($row[0]==$search)
      $exists=1;
  }
 $select=@mysql_select_db($dbname);

  if(!$select) { //e�er ba�lant� hatas� olursa
    $goto=file_get_contents("template/db_connection_error.html");
    $page=temp_replace("check_db",$goto,$page);
    $page=temp_replace("ERROR_MSG",_lang_install_connection_error,$page);
    $page=temp_replace("IF_NOT_FORWARD",_lang_install_if_not_forward." <a href=\"$back\">"._lang_install_click_here."</a>",$page);
    $page=forward($back,2,$page);
  }
  elseif($exists=="1"){ //e�er belirlenen prefixli 'beedon' tablosu mevcutsa
    $goto=file_get_contents("template/prefix_exists.html");
    $page=temp_replace("check_db",$goto,$page);
    $page=temp_replace("ERROR_MSG",_lang_install_prefix_error,$page);
    $page=temp_replace("info_text",_lang_install_prefix_error_info,$page);
    $page=temp_replace("IF_NOT_FORWARD",_lang_install_if_not_forward." <a href=\"$back\">"._lang_install_click_here."</a>",$page);
    $page=forward($back,2,$page);
  }
  else
    {  //her�ey tamamsa index.php'de belirlenen $dbfile'a de�i�kenleri yaz
      $yazilacak= $dbfile;
      $fp = fopen ($yazilacak,"w");
      fwrite ($fp,"<?
//Veri tabani ayarlari 
\$dbhost=\"$dbhost\";
\$dbname=\"$dbname\";
\$dbuser=\"$dbuser\";
\$dbpass=\"$dbpass\";
\$dbprefix=\"$dbprefix\";
//--------------- 
?>");
      fclose ($fp);
  
      // daha sonra ekrana y�netici yap�land�rmas�n� yazd�r
      // bkz : template
      $goto=file_get_contents("template/admin_conf.html");
      $page=temp_replace("check_db",$goto,$page);
      $page=temp_replace("admin_header",_lang_install_admin_header,$page);
      $page=temp_replace("info_text",_lang_install_admin_info,$page);
      $page=temp_replace("nick",_lang_install_nick,$page);
      $page=temp_replace("email",_lang_install_email,$page);
      $page=temp_replace("pass",_lang_install_pass,$page);
      $page=temp_replace("passagain",_lang_install_passagain,$page);
      $page=temp_replace("submit_text",_lang_install_submit,$page);
    }
} #if || referer check
else { //e�er direkt eri�im varsa
  echo "<div align=\"center\">"._lang_you_cannot_access_directly."</div>";
  exit;
}

?>
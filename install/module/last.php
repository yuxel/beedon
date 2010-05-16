<?
/*---------------------
Site yap�land�rmas�n� dosyaya yaz
ve temel tablolar� olu�tur
-------------------------*/
if(search_string("module=site_conf",$back))  //sayfaya diret eri�im izni verilmesin
{ //e�er direkt eri�im yoksa

  include "$adminfile";
  include "$dbfile";

  //de�i�kenleri al
  $site_title=htmlspecialchars($_POST['title']);
  $site_slogan=htmlspecialchars($_POST['slogan']);
  $site_footer=htmlspecialchars($_POST['footer']);  //functions.php
  $site_charset=htmlspecialchars($_POST['charset']);
  $site_startdate=htmlspecialchars($_POST['startdate']);
  $site_theme=htmlspecialchars($_POST['theme']);
  $site_lang=htmlspecialchars($_POST['lang']);


  // site yap�land�rmas�n� dosyaya yaz
  $rayt=$sitefile;
  $fp = @fopen ($rayt,"w");
  @fwrite ($fp,"<?
//Site ayarlar�
\$title=\"$site_title\";
\$slogan=\"$site_slogan\";
\$footer=\"".addslashes($site_footer)."\";
\$charset=\"$site_charset\";
\$startdate=\"$site_startdate\";
\$site_theme=\"$site_theme\";
\$site_lang=\"$site_lang\";
?>");
  @fclose ($fp);
  //veritaban� ayarlar�n� dosyaya yaz

  $yazilacak= $mainconfig;
  $fp = @fopen ($yazilacak,"w");
  if(@fwrite ($fp,"<?
//Veri tabani ayarlari 
\$dbhost=\"$dbhost\";
\$dbname=\"$dbname\";
\$dbuser=\"$dbuser\";
\$dbpass=\"$dbpass\";
\$dbprefix=\"$dbprefix\";
//Y�netici ayarlar�
\$adminnick=\"$adminnick\";
\$adminmail=\"$adminmail\";
?>")) $writeok=1; else $writeok=0;
  @fclose ($fp);
  //
  $errors=0;
  //

  if($writeok=="1") 
    { //temel tablolar� olu�tur
    mysql_connect($dbhost,$dbuser,$dbpass);
    mysql_select_db($dbname);
      /*-----------------*/
      //----------SORGULAR -------*/
      //site ayarlar�
      $beedon="create table ${dbprefix}beedon (admin varchar(20),mail varchar(30), title varchar(20), slogan varchar(30), footer varchar(250), charset varchar(10), startdate date, theme varchar(15), lang varchar(5), want_activation tinyint(2))";
      //�yeler
      $members="create table ${dbprefix}members (id INT(10) NOT NULL AUTO_INCREMENT,  nick varchar(20), password varchar(20), auth tinyint(2), theme varchar(20), mail varchar(40), language varchar(4),mail_on tinyint(2), real_name varchar(50), icq varchar(20), msn varchar(50), yahoo varchar(50), jabber varchar(50), signature varchar(50), avatar varchar(20), location varchar(20), homepage varchar(50), is_active tinyint(2), activation_code varchar(20), PRIMARY KEY (id))";
      //mod�ller
      $modules="create table ${dbprefix}modules (mid INT(10) NOT NULL AUTO_INCREMENT, modactive tinyint(2), name varchar(20),auth tinyint(2), PRIMARY KEY (mid))";
      //dosya bloklar/mod�l bloklaro
      $module_blocks="create table ${dbprefix}module_blocks (bid INT(10) NOT NULL AUTO_INCREMENT, blockactive int, name varchar(20), file varchar(20), auth tinyint(2),location varchar(20), PRIMARY KEY (bid))";
      //kendi yapt���n dosyalar
      $blocks="create table ${dbprefix}blocks (blid INT(10) NOT NULL AUTO_INCREMENT, blockactive tinyint(2), header varchar(20), content text, name varchar(20), auth tinyint(2),location varchar(20), PRIMARY KEY (blid))";
      //�zel mesajlar
      $messages="create table ${dbprefix}messages (mid INT(10) NOT NULL AUTO_INCREMENT, from_who varchar(20), to_who varchar(20), time datetime, header varchar(20), content text, if_read tinyint(2), PRIMARY KEY (mid))";
      //men� ��eleri
      $menu="create table ${dbprefix}menu (menuid INT(10) NOT NULL AUTO_INCREMENT, name varchar(20), url varchar(50), related_module varchar(25), priority int(10), PRIMARY KEY (menuid))";
      //ba�lang�� sayfas�
      $start_page="create table ${dbprefix}start_page (comment_on tinyint(2), header varchar(50), content text, module_on tinyint(2), module varchar(20))";
      //y�netim mod�lleri
      $administration="create table ${dbprefix}administration (a_module varchar(20), admin_auth tinyint(2),name varchar(20))";
      //istatistikler
      $stats="create table ${dbprefix}stats (stid INT(10) NOT NULL AUTO_INCREMENT, nick varchar(25), ip varchar(50), os varchar(10), browser varchar(10), page varchar(50), time datetime, sessionid varchar(22), PRIMARY KEY (stid))";


      //tabblo ad�n� ve tablo sorgusunu i�eren array = $tablelist

      $tablelist=array("beedon"=>"$beedon",
		       "members"=>"$members",
		       "modules"=>"$modules",
		       "module_blocks"=>"$module_blocks",
		       "blocks"=>"$blocks",
		       "messages"=>"$messages",
		       "menu"=>"$menu",
		       "start_page"=>"$start_page",
		       "administration"=>"$administration",
		       "stats"=>"$stats"
		       );


      //$tablelistteki her ��eyi kurulabiliyorsa kur, kurulam�yorsa hata mesaj� ver
      foreach($tablelist as $tablename => $tablequery) {
	if(mysql_query($tablequery)) $msg.= "$tablename : ". _lang_install_table_create_ok;  //0 i�in functions.php'ye bak�n
	else { 
	  $msg.="$tablename : "._lang_install_table_create_error;  
	  $errors++; //e�er hata olursa $errors de�i�kenini bir artt�r
	} #else
	    $msg.="<br>";
      } #foreach 


	  mysql_close(); //veritaban� ba�lant�s� kes
   
      $page=temp_replace("write_file",_lang_install_write_success,$page);
      $page=temp_replace("msg",$msg,$page);
    }
  else {
    $page=temp_replace("write_file",_lang_install_write_fail,$page);
    $page=temp_replace("msg",_lang_install_turnback_fix,$page);
    $errors++;

  }


  if($errors!=0){
    $page=temp_replace("retry","<a href=\"?module=db\">"._lang_install_back."</a>",$page);
  }
  else
    $page=temp_replace("retry","<a href=\"?module=finish\">"._lang_install_finish."</a>",$page);

} #if || referer check
else { //e�er direkt eri�im varsa
  echo "<div align=\"center\">"._lang_you_cannot_access_directly."</div>";
  exit;
}

?>
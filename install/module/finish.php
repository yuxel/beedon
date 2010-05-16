<?
/*--------------------
Tablo içeriklerini yaz ve kurulumu sonlandýr
---------------------*/
if(search_string("module=last",$back))  //sayfaya diret eriþim izni verilmesin
{ //eðer direkt eriþim yoksa

  $date=get_date()." ".get_time();  //functions.php

  // geçici dosyalarý al
  include "$adminfile";
  include "$dbfile"; 
  include "$sitefile"; 
  connect_db($dbhost,$dbuser,$dbpass,$dbname);
  //tablolar için baþlangýç öðerlerini ekle
  //site özelliklerini yaz
  @db_query("insert into ${dbprefix}beedon (admin,mail,title,slogan,footer,charset,startdate,theme,lang,want_activation) values ('$adminnick','$adminmail','$title','$slogan','$footer','$charset','$startdate','$site_theme','$site_lang','1')");

  //kullanýcýlarý oluþtur
  @db_query("insert into ${dbprefix}members (nick,password,auth,theme,mail,language,is_active) values ('$adminnick','$adminpass','4','$site_theme','$adminmail','$site_lang','1')");
  @db_query("insert into ${dbprefix}members (nick,password,auth,theme,mail,language,is_active) values ('beeman','','1','$site_theme','','$site_lang','1')");

  //modulleri yaz
  @db_query("insert into ${dbprefix}modules (modactive,name,auth) values ('1','home','1')");
  @db_query("insert into ${dbprefix}modules (modactive,name,auth) values ('1','users','1')");
  @db_query("insert into ${dbprefix}modules (modactive,name,auth) values ('1','admin','3')");
  @db_query("insert into ${dbprefix}modules (modactive,name,auth) values ('1','stats','1')");

  //menü öðelerini yaz
  @db_query("insert into ${dbprefix}menu (name,url,related_module,priority) values('"._lang_home_page."','?module=home','home','1')");
  @db_query("insert into ${dbprefix}menu (name,url,related_module,priority) values('"._lang_your_account."','?module=users','users','2')");
  @db_query("insert into ${dbprefix}menu (name,url,related_module,priority) values('"._lang_user_list."','?module=users&action=list','users','3')");
  @db_query("insert into ${dbprefix}menu (name,url,related_module,priority) values('"._lang_stats."','?module=stats','stats','4')");

  //yöneticiye hoþgeldin mesajý gönder
  @db_query("insert into ${dbprefix}messages (from_who, to_who, time, header, content,if_read) values ('beedon','$adminnick','${date}','"._lang_welcome."','"._lang_welcome." $adminnick,\n "._lang_auto_welcome_msg."','0')");

  //blok ekle
  @db_query("insert into ${dbprefix}module_blocks (blockactive, name, file, auth, location) values ('1','"._lang_blocks_user."','user_block','1','right')");

  //baþlangýç sayfasý özelliklerini belirle
  @db_query("insert into ${dbprefix}start_page (comment_on,header,content,module_on,module) values ('1','"._lang_start_page_content_header."','"._lang_start_page_content."','0','')");



  //yönetim modüllerini yaz
  @db_query("insert into ${dbprefix}administration (a_module, admin_auth) values ('modules','4')");
  @db_query("insert into ${dbprefix}administration (a_module, admin_auth) values ('block','3')");
  @db_query("insert into ${dbprefix}administration (a_module, admin_auth) values ('menu','3')");
  @db_query("insert into ${dbprefix}administration (a_module, admin_auth) values ('setup','3')");
  @db_query("insert into ${dbprefix}administration (a_module, admin_auth) values ('start_page','3')");
  @db_query("insert into ${dbprefix}administration (a_module, admin_auth) values ('users','4')");
  @db_query("insert into ${dbprefix}administration (a_module, admin_auth) values ('backup','4')");


  $page=temp_replace("content",_lang_install_end,$page);
  $page=temp_replace("if_not_forward",_lang_install_if_not_forward." <a href=\"../\">"._lang_install_click_here."</a>",$page);
  $page=forward("../",10,$page);



  @close_db($connect_to_db); //veritabaný baðlantýsý kapat
} #if || referer check
else { //eðer direkt eriþim varsa
  echo "<div align=\"center\">"._lang_you_cannot_access_directly."</div>";
  exit;
}
?>
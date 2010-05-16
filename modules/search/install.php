<?
/*--------------------------
haber modülü kurulum dosyasý
-----------------------*/
//gerekli tablolarý oluþtur
db_drop_table("${dbprefix}search");

db_query("create table ${dbprefix}search (sid INT(10) NOT NULL AUTO_INCREMENT, header varchar(30),table_name varchar(40), identifier varchar(40), header_field varchar(40),fields_to_search text, url_to_go text, is_active tinyint(2), is_checked tinyint(2), PRIMARY KEY (sid))");

@db_query("insert into ${dbprefix}menu (name,url,related_module,priority) values ('"._lang_search."','?module=search','search','99')");

//gerekli içeriði tablolara ekle

@db_query("insert into ${dbprefix}administration values ('search','1','search')");

?>

<?
/*--------------------------
haber modülü kurulum dosyasý
-----------------------*/
//gerekli tablolarý oluþtur

db_drop_table("${dbprefix}news");
db_drop_table("${dbprefix}news_topics");
db_drop_table("${dbprefix}news_comments");
db_drop_table("${dbprefix}news_setup");

@db_query("create table ${dbprefix}news (nid INT(10) NOT NULL AUTO_INCREMENT, header varchar(40), content text, sender varchar(25), topic varchar(25), editor varchar(25), counter INT(255), time datetime, PRIMARY KEY (nid))");

@db_query("create table ${dbprefix}news_topics (tid INT(10) NOT NULL AUTO_INCREMENT, name varchar(20), description text, image varchar(25), PRIMARY KEY (tid))");

@db_query("create table ${dbprefix}news_comments (cid INT(10) NOT NULL AUTO_INCREMENT, user varchar(25), header varchar(20), content text, newsid int(10), related_comment int(10), time datetime, PRIMARY KEY (cid))");

@db_query("create table ${dbprefix}news_setup (news_per_page int(10), comments_on int(1))");


//gerekli içeriði tablolara ekle
@db_query("insert into ${dbprefix}news_setup (news_per_page, comments_on) values('5','0')");

@db_query("insert into ${dbprefix}news_topics (name,description,image) values ('others','Others','others.png')");

@db_query("insert into ${dbprefix}administration values ('news','3','')");
@db_query("insert into ${dbprefix}menu (name,url,related_module,priority) values ('"._lang_news."','?module=news','news','99')");
@db_query("insert into ${dbprefix}menu (name,url,related_module,priority) values ('"._lang_send_news."','?module=news&action=send_news','news','99')");
?>

<?
/*----------------
Mod�l kald�rma kurallar�
------------------*/

//tablolar� ve i�eri�i kald�r
//men� ��eleri otomatik silinceketir

db_drop_table("${dbprefix}news");
db_drop_table("${dbprefix}news_comments");
db_drop_table("${dbprefix}news_topics");
db_drop_table("${dbprefix}news_setup");
@db_query("delete from ${dbprefix}administration where a_module='news'");

?>
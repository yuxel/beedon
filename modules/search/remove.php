<?
/*----------------
Mod�l kald�rma kurallar�
------------------*/

//tablolar� ve i�eri�i kald�r
//men� ��eleri otomatik silinceketir
db_drop_table("${dbprefix}search");
@db_query("delete from ${dbprefix}administration where a_module='search'");

?>
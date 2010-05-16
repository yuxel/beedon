<?
/*----------------
Modül kaldýrma kurallarý
------------------*/

//tablolarý ve içeriði kaldýr
//menü öðeleri otomatik silinceketir
db_drop_table("${dbprefix}search");
@db_query("delete from ${dbprefix}administration where a_module='search'");

?>
<?
/*--------------------------
haber mod�l� kurulum dosyas�
-----------------------*/
//gerekli tablolar� olu�tur
db_drop_table("${dbprefix}my");
@db_query("create table ${dbprefix}my (myid INT(10) NOT NULL AUTO_INCREMENT, name varchar(20), content text, sender varchar(25), counter INT(255), time datetime, PRIMARY KEY (myid))");

//gerekli i�eri�i tablolara ekle
@db_query("insert into ${dbprefix}administration values ('my','3','my')");

?>

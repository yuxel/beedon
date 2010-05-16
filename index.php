<?
ini_set("memory_limit", "16M");

@include_once "include/kernel.php";  //session ve cookie olaylar�
@include_once "config/config.php";  // veritaban� ayarlar�
@include_once "include/functions.php"; //genel fonksiyonlar
@include_once "include/header.php";   // veritaban� ba�lant�s� + temel kullan�c� ve site �zellikleri
@include_once "include/stats.php"; //kullanici giri�lerini tabloya yaz ve online kullanicilari bul
@include_once "include/page_items.php"; //sayfadaki bloklar, mod�ller ve men� 
@include_once "include/page.php";  //header.php'de al�nan tema ve di�er bilgilere g�re page_items.php deki ��elerin olu�turulup sayfaya bas�lmas�
@include_once "include/footer.php"; //toplam sorgu + sayfa �retimi + veritaban� ba�lant�s�n�n kapat�lmas�
?>

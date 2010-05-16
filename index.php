<?
ini_set("memory_limit", "16M");

@include_once "include/kernel.php";  //session ve cookie olaylarý
@include_once "config/config.php";  // veritabaný ayarlarý
@include_once "include/functions.php"; //genel fonksiyonlar
@include_once "include/header.php";   // veritabaný baðlantýsý + temel kullanýcý ve site özellikleri
@include_once "include/stats.php"; //kullanici giriþlerini tabloya yaz ve online kullanicilari bul
@include_once "include/page_items.php"; //sayfadaki bloklar, modüller ve menü 
@include_once "include/page.php";  //header.php'de alýnan tema ve diðer bilgilere göre page_items.php deki öðelerin oluþturulup sayfaya basýlmasý
@include_once "include/footer.php"; //toplam sorgu + sayfa üretimi + veritabaný baðlantýsýnýn kapatýlmasý
?>

<?
ini_set("arg_separator.output","&amp;");  
//php bazý hostlarda (arg_separator'un & olduðu hostlar) linklerin sonuna &PHPSESSID ile sessionid deðerini ekliyor ve
//html validation'ý bozuyor. & -> &amp; olunca herþey düzeliyor.

$i = explode(' ',microtime());    //sayfa üretimi için sayacý baþlat, footer.php'de durdur
$sys['starttime'] = $i[1] + $i[0];

/*-----------------------------
//----------------------//
Session ve cookie olaylarý
----------------------------*/
session_start();
session_register("bee_name");			//kullanici adi deðiþkeni
session_register("bee_pass_hash");		//md5'den geçirilmiþ kullanýcý þifresi deðiþkeni
session_register("bee_remember_me");	//bilgiler cookie'ye yazilacak mi ?


if((isset($_COOKIE['bee_remember_me'])=="0") OR $_SESSION['bee_remember_me']=="0")  //kullaný çýkýþý
{
  $_COOKIE['bee_name']="beeman";
  $_COOKIE['bee_pass_hash']="";
  setcookie("bee_name", "", time()-1);
  setcookie("bee_pass_hash", "", time()-1);
  setcookie("bee_remember_me", "", time()-1);
}

//beni hatýrla seçeneði aktifleþtirilmiþ dolayýsýyla cookie'ye yazýlmýþsa
if((isset($_COOKIE['bee_remember_me'])=="1") AND !isset($_SESSION['bee_name']))
{
  if($_COOKIE['bee_name']) { //bee_name'i eþitle
    $_SESSION['bee_name']=$_COOKIE['bee_name'];
    $GLOBALS['bee_name']=$_COOKIE['bee_name'];

  }

  if($_COOKIE['bee_pass_hash']) { //bee_pass_hash'i eþitle
    $_SESSION['bee_pass_hash']=$_COOKIE['bee_pass_hash'];
    $GLOBALS['bee_pass_hash']=$_COOKIE['bee_pass_hash'];

  }

  if($_COOKIE['bee_remember_me']) { //bee_remember_me'yi eþitle
    $_SESSION['bee_remember_me']=$_COOKIE['bee_remember_me'];
    $GLOBALS['bee_remember_me']=$_COOKIE['bee_remember_me'];

  }

} // önceden giriþ <- son

$bee_name=$_SESSION['bee_name'];
$bee_pass_hash=$_SESSION['bee_pass_hash'];




if($_SESSION['bee_remember_me']=="1") { /* eðer bee_remember_me 1 ise bilgileri cookie'ye yaz */

  $bee_name=$_SESSION['bee_name'];
  $bee_pass_hash=$_SESSION['bee_pass_hash'];

  setcookie("bee_name", "$bee_name", time()+60*60*24*10); 		//10 gün
  setcookie("bee_pass_hash", "$bee_pass_hash", time()+60*60*24*10);
  setcookie("bee_remember_me", "1", time()+60*60*24*10);
}


/* Eðer session deðiþkenlerinden veya cookie'den isim okunamýyorsa default kullanici 
olan beeman'e atama yapýlýyor */
if(!$_SESSION['bee_name']) {
  $_SESSION['bee_name']="beeman";
  $GLOBALS['bee_name']="beeman";
}
if(!$_SESSION['bee_pass_hash']){
  $_SESSION['bee_pass_hash']="";
  $GLOBALS['bee_pass_hash']="";
}
global $totalquery;  //sayfadki toplam sorgu sayýsý
$totalquery=0;
?>

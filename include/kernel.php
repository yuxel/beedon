<?
ini_set("arg_separator.output","&amp;");  
//php baz� hostlarda (arg_separator'un & oldu�u hostlar) linklerin sonuna &PHPSESSID ile sessionid de�erini ekliyor ve
//html validation'� bozuyor. & -> &amp; olunca her�ey d�zeliyor.

$i = explode(' ',microtime());    //sayfa �retimi i�in sayac� ba�lat, footer.php'de durdur
$sys['starttime'] = $i[1] + $i[0];

/*-----------------------------
//----------------------//
Session ve cookie olaylar�
----------------------------*/
session_start();
session_register("bee_name");			//kullanici adi de�i�keni
session_register("bee_pass_hash");		//md5'den ge�irilmi� kullan�c� �ifresi de�i�keni
session_register("bee_remember_me");	//bilgiler cookie'ye yazilacak mi ?


if((isset($_COOKIE['bee_remember_me'])=="0") OR $_SESSION['bee_remember_me']=="0")  //kullan� ��k���
{
  $_COOKIE['bee_name']="beeman";
  $_COOKIE['bee_pass_hash']="";
  setcookie("bee_name", "", time()-1);
  setcookie("bee_pass_hash", "", time()-1);
  setcookie("bee_remember_me", "", time()-1);
}

//beni hat�rla se�ene�i aktifle�tirilmi� dolay�s�yla cookie'ye yaz�lm��sa
if((isset($_COOKIE['bee_remember_me'])=="1") AND !isset($_SESSION['bee_name']))
{
  if($_COOKIE['bee_name']) { //bee_name'i e�itle
    $_SESSION['bee_name']=$_COOKIE['bee_name'];
    $GLOBALS['bee_name']=$_COOKIE['bee_name'];

  }

  if($_COOKIE['bee_pass_hash']) { //bee_pass_hash'i e�itle
    $_SESSION['bee_pass_hash']=$_COOKIE['bee_pass_hash'];
    $GLOBALS['bee_pass_hash']=$_COOKIE['bee_pass_hash'];

  }

  if($_COOKIE['bee_remember_me']) { //bee_remember_me'yi e�itle
    $_SESSION['bee_remember_me']=$_COOKIE['bee_remember_me'];
    $GLOBALS['bee_remember_me']=$_COOKIE['bee_remember_me'];

  }

} // �nceden giri� <- son

$bee_name=$_SESSION['bee_name'];
$bee_pass_hash=$_SESSION['bee_pass_hash'];




if($_SESSION['bee_remember_me']=="1") { /* e�er bee_remember_me 1 ise bilgileri cookie'ye yaz */

  $bee_name=$_SESSION['bee_name'];
  $bee_pass_hash=$_SESSION['bee_pass_hash'];

  setcookie("bee_name", "$bee_name", time()+60*60*24*10); 		//10 g�n
  setcookie("bee_pass_hash", "$bee_pass_hash", time()+60*60*24*10);
  setcookie("bee_remember_me", "1", time()+60*60*24*10);
}


/* E�er session de�i�kenlerinden veya cookie'den isim okunam�yorsa default kullanici 
olan beeman'e atama yap�l�yor */
if(!$_SESSION['bee_name']) {
  $_SESSION['bee_name']="beeman";
  $GLOBALS['bee_name']="beeman";
}
if(!$_SESSION['bee_pass_hash']){
  $_SESSION['bee_pass_hash']="";
  $GLOBALS['bee_pass_hash']="";
}
global $totalquery;  //sayfadki toplam sorgu say�s�
$totalquery=0;
?>

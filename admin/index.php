<?
/*---------------------
Yönetim modülü
------------------------*/
$a_module=$_GET['a_module'];  //admin modülleri
$navigation="| ";

//administration tablosundaki modülleri link olarak sýrala
$adminq=@db_query("select * from ${dbprefix}administration");
while ($data = db_fetch_row($adminq)) {
    $fname=$data[0];
    if(!$data[2]) $name=$data[0];
    else $name=$data[2];
    $navigation.="<a href=\"?module=admin&amp;a_module=$fname\">$name</a> | ";
}

$start=file_get_contents("admin/template/start.html");
$page=temp_replace("module",$start,$page);
$page=temp_replace("navigation",$navigation,$page);
$atemp_dir="admin/modules/$a_module/template";
$content_dir="admin/modules/$a_module/content";
if(!$a_module) $page=temp_replace("content","",$page);
else
{ //yetkiye göre yönetim modülü dosyasýný, yönetim modül içindeki dil dosyasýný ve yönetim modülünün yönettiði modül içindeki dil dosyasýný al
$authq=@db_query("select * from ${dbprefix}administration where a_module='$a_module' and admin_auth<='$auth'");
if(@db_num_rows($authq) <1) $page=temp_replace("content",_lang_permission_denied,$page);
else{
    $start=file_get_contents("admin/modules/$a_module/template/start.html");
    if (file_exists("modules/$amodule/lang/$lang.php")) include "modules/$amodule/lang/$lang.php";
    include "admin/modules/$a_module/lang/$lang.php";
    $mtemp_dir="admin/modules/$a_module/template";  //template dizini
    include "admin/modules/$a_module/content/index.php";
}
}
?>
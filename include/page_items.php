<?
/*---------------------------
Sayfa elementleri
-------------------------*/

function num_left_blocks($auth){  //soldaki bloklar�n say�s�
  global $dbprefix;
  $get=@db_query("select bid from ${dbprefix}module_blocks where blockactive='1' and location='left' and auth<='$auth'");  
  //dosya bloklar
  $res=@db_num_rows($get);
  $get=@db_query("select blid from ${dbprefix}blocks where blockactive='1' and location='left' and auth<='$auth'"); //keni bloklar�
  $res=$res+@db_num_rows($get);
  return $res;
}

function num_right_blocks($auth){  //sa�daki blok say�s�
  global $dbprefix;

  $get=@db_query("select bid from ${dbprefix}module_blocks where blockactive='1' and location='right' and auth<='$auth'");
  //dosya bloklar
  $res=@db_num_rows($get);
  $get=@db_query("select blid from ${dbprefix}blocks where blockactive='1' and location='right' and auth<='$auth'"); //keni bloklar�
  $res=$res+@db_num_rows($get);


  return $res;
}

//
function write_right_blocks($auth){ //$auth yetkisine sahip kullan�c�lar soldaki bloklar� yazd�r
  global $dbprefix,$lang;
  include "lang/$lang.php";
  $block_temp_location=$GLOBALS['block_temp_location'];
  $block_temp=file_get_contents("$block_temp_location");
  $get=@db_query("select * from ${dbprefix}module_blocks where blockactive='1' and location='right' and auth<='$auth'");
  while($data=@db_fetch_row($get))
    {
      
      $block=$block_temp;
      $block=temp_replace("header",$data[2],$block);

      include "blocks/".$data[3].".php";

#$block=temp_replace("content",include ("blocks/".$data[3].".php"),$block);
      $res=$res."\n".$block."<br>\n";
    }

  $getx=@db_query("select * from ${dbprefix}blocks where blockactive='1' and location='right' and auth<='$auth'");
  while($datax=@db_fetch_row($getx))
    {
      $block=$block_temp;
      $block=temp_replace("header",$datax[2],$block);
      $block=temp_replace("content",to_html($datax[3]),$block);
      $res=$res.$block."<br>";
    }

  return $res;
}


function write_left_blocks($auth){  //$auth yetkisine sahip kullan�c�lar soldaki bloklar� yazd�r
  global $dbprefix;
  $block_temp_location=$GLOBALS['block_temp_location'];
  $block_temp=file_get_contents("$block_temp_location");

  $get=@db_query("select * from ${dbprefix}module_blocks where blockactive='1' and location='left' and auth<='$auth'");
  while($data=@db_fetch_row($get))
    {
      $block=$block_temp;
      $block=temp_replace("header",$data[2],$block);
      include "blocks/".$data[3].".php";
      $res=$res.$block."<br>";
    }

  $getx=@db_query("select * from ${dbprefix}blocks where blockactive='1' and location='left' and auth<='$auth'");
  while($datax=@db_fetch_row($getx))
    {
      $block=$block_temp;
      $block=temp_replace("header",$datax[2],$block);
      $block=temp_replace("content",to_html($datax[3]),$block);
      $res=$res.$block."<br>";
    }
  return $res;
}


function write_module($module,$auth,$page){  //$page de�i�kenine gelen mod�l� $auth yetkisine g�re yaz
  global $dbprefix;
  $get=@db_query("select * from ${dbprefix}modules where name='$module'");  //mod�l veritaban�nda var m� ?
  while($data=@db_fetch_row($get))
    {
      $modactive=$data[1];  //aktif mi ?
      $modauth=$data[3];  //mod�l i�in gerekli yetki nedir ?
    }

  if($module=="admin") $module_file="admin/index.php";  //e�er mod�l admin ise �zel durum $modul_file modules i�inden de�il admin/index.php i�inden a��l�yor
  else $module_file="modules/$module/index.php";

  if(!file_exists("$module_file")) $page=temp_replace("module",_lang_module_not_exists,$page);  //e�er b�yle bir dosya yoksa
  elseif($modactive!=1) $page=temp_replace("module",_lang_module_not_active,$page);  //mod�l aktif de�ilse
  elseif($modauth>$auth)     $page=temp_replace("module",_lang_module_permission_denied,$page);  //yetki yetmiyorsa

  else {  //e�er her�ey normalse mod�l dosyas�n� y�kle
    global $lang,$page,$temp_dir,$content_dir;
    // dil de�i�keni, sayfa, mod�l template klas�r� , mod�l content klas�r�
    if($module!="admin") include "modules/$module/lang/$lang.php";  //mod�l dil dosyas�n� y�kle
    $referer=$_SERVER['HTTP_REFERER'];  //geri d�n�� i�in referer kayd�
    if($referer) $back=$referer;
    else $back=".";    //e�er direkt eri�im varsa $back="."
    $temp_dir="modules/$module/template";
    $content_dir="modules/$module/content";
    $action=$_GET['action'];  //action al
    $effect=$_GET['effect'];  //effect all
    include "$module_file";  //dosyay� y�kle
  }
  return $page;
}
//
function get_vertical_menu($auth){  //yatay men�y� al
  global $dbprefix,$menuitems,$menuurls;
  
  $menu="<span class=\"ver_menu\">";  //men� css dosyas�ndaki ver_menu class'�nda yaz�lacak
  $get=@db_query("select * from ${dbprefix}menu order by priority asc"); //men�y� al
  while($data=@db_fetch_row($get))
    { $menuitems[]=$data[1];  //array'e at
      $menuurls[$data[1]]=$data[2];  //url'leri de array'e at
      $name=$data[1];
      $url=$data[2];
      $url=htmlspecialchars($url);  //html validation i�in
      $menu=$menu." | "."<a class=\"ver_menu\" href=\"$url\">$name</a>";
    }
  $menu=$menu." | </span>";

  return $menu;
}
?>

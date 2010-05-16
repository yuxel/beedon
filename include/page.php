<?
/*--------------------
Sayfay oluturma
---------------------*/
global $module;
$module=$_GET['module'];  //module' al
if(!$module) $module="home";  //�tanml home
//

$file=$theme_dir."/template/start.html";  //ilk olarak tema'nn start.html dosyas a�lacak
$page=file_get_contents($file);
$page=temp_replace("footer",to_html($footer),$page);  //header.php
$page=temp_replace("charset",$charset,$page); //header.php
$page=temp_replace("title",$title,$page);//header.php
$page=temp_replace("slogan",$slogan,$page);//header.php
$page=temp_replace("style_file",$style_file,$page); //style_file da tema i�ndeki index.php'den geliyor
$menu=get_vertical_menu($auth);  //page_items.php
$page=temp_replace("vertical_menu",$menu,$page);
$num_right=num_right_blocks($auth); //page_items.php
$num_left=num_left_blocks($auth);//page_items.php
$total_blocks=0;
$space_left="#left_block#";  //sol bloklar tema i�nde #left_block# yazan yere
$space_right="#right_block#";  //sa�bloklar tema i�nde #right_block# yazan yere

$tableOpenTag="<table style=\"width: 100%; height: 75%; text-align: left; vertical-align: top;\"
 border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
<tr>";

$tableCloseTag="</tr></table>";




if($num_left>0) //e�r solda blk varsa sol tarafa %10 yer ayr
{
  $space_left=$tableOpenTag."<td class=\"left_blocks\">#left_block#</td>";

  $total_blocks++;
}
if($num_left==0) //de�lse bo brak
{
  $moduleTagOpen=$tableOpenTag;
  $space_left="";
}

if($num_right>0) //e�r sa�a blk varsa sa�tarafa %10 yer ayr
{
  $space_right="<td class=\"right_blocks\">#right_block#</td>".$tableCloseTag;
  $total_blocks++;
}
if($num_right==0) 
{
  $moduleTagClose=$tableCloseTag;
  $space_right="";  //de�lse bo brak
}

$width_module=100-(12*$total_blocks);  //sa�a veya solda modl olmasna g�e ana modl i�n yer ayr




//eger tag acilacaksa ac, kapanacaksa kapat ( bloklara gore)
$space_module=$moduleTagOpen."<td class=\"write_modules\" >#module#</td>".$moduleTagClose;  


$page=temp_replace("module",$space_module,$page);  //modl i�n td olutur
$page=write_module($module,$auth,$page);   //yetkiye g�e modl yaz
$page=temp_replace("left_block",$space_left,$page);  //sol blok i�n td olutur
$page=temp_replace("right_block",$space_right,$page); //sa�blok i�n td olutur
$page=temp_replace("left_block",write_left_blocks($auth),$page); //sol blo� yaz
$page=temp_replace("right_block",write_right_blocks($auth),$page);  //sa�blo� yaz
$page=temp_replace("image_dir",$image_dir,$page);  //image_dir tema i�ndeki index.php'den geliyor
?>
<?
/*---------------------
haber mod�l�
--------------------*/
global $temp_dir;
$id=$_GET['id'];
//temp_dir include/page_items.php'de $temp_dir="modules/$module/template"; olarak belirlendi

$msg_file=file_get_contents("$temp_dir/msg.html");
//$action'lara g�re dosyalar� y�kle
if(!$id) include "$content_dir/list.php";
elseif($id) include "$content_dir/show.php";

?>

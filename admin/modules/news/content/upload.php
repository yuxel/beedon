<?
include "../../../../include/functions.php";
$fileposted="user_image";
$storedir="../../../../image/topics/";
$prefix=rand()%10;

echo is_writeable("$storedir./$prefix");

if(is_uploaded_file($HTTP_POST_FILES[$fileposted]['tmp_name']))
{
    $tmp_name = $HTTP_POST_FILES[$fileposted]['tmp_name'];
    $file_name = $HTTP_POST_FILES[$fileposted]['name'];
    $size = $HTTP_POST_FILES[$fileposted]['size'];

    $type = array_pop(split("\.", $file_name));
    $size_limit = 1096100;


    if($type!="png" AND $type!="gif" AND $type!="jpg" AND $type!="jpeg") echo "Sadece resimleri gönderebilirsiniz";
    elseif($size>$size_limit) echo "Dosya boyutu çok büyük";
    else {

        $file_name = $prefix.$file_name;
        move_uploaded_file($tmp_name, $storedir.$prefix.$file_name);
        echo "Dosya yüklendi : ".$prefix.$file_name;
    } #else
}
?>
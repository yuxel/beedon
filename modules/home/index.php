<?
$st_file=@file_get_contents("$temp_dir/start.html");
$page=temp_replace("content",$st_file,$page);
$get_values=@db_query("select * from ${dbprefix}start_page");


while($data=@db_fetch_row($get_values))
{
  $fcomment_on=$data[0];
  $fheader=$data[1];
  $fcontent=$data[2];
  $fmodule_on=$data[3];
  $fmodule=$data[4];
}

if($fcomment_on=="1"){
  $coment_temp=file_get_contents("modules/home/template/comment.html");
  $wcoment=temp_replace("header",$fheader,$coment_temp);
  $wcoment=temp_replace("content",to_html($fcontent),$wcoment);
  $write_page=$wcoment."<br>";
}

if($fmodule_on=="1") $page=temp_replace("module",$write_page."#module#",$page);
else $page=temp_replace("module",$write_page,$page);

$page=write_module($fmodule,$auth,$page);
?>
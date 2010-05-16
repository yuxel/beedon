<?
$listmycontent=db_query("select * from ${dbprefix}my order by myid desc");
if(db_num_rows($listmycontent)>0) {
while($data=db_fetch_row($listmycontent)) {
$myt=file_get_contents("$temp_dir/list.html");
$myout=temp_replace("name",$data[1],$myt);
$myout=temp_replace("id",$data[0],$myout);
$myout=temp_replace("author",$data[3],$myout);
$out.=$myout;
}
$page=temp_replace("module",$out,$page);
} #if
else{
$page=temp_replace("module",$msg_file,$page);
$page=temp_replace("msg",_lang_no_content,$page);
$page=temp_replace("if_not_forward","",$page);
} #else





?> 

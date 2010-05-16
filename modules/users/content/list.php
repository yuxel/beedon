<?
$mfile=file_get_contents("$temp_dir/list.html");
$quser=@db_query("select nick from ${dbprefix}members where is_active='1' and nick!='beeman' order by nick");
while ($data=db_fetch_row($quser)){
  $nickname=$nickname.$data[0]."<br>";
  $click=$click."<a href=\"?module=users&amp;action=info&amp;user=$data[0]\">"._lang_see_info."</a><br>";
  $spacer=$spacer."&gt;<br>";
} # while
$page=temp_replace("content","<br>".$mfile,$page);
$page=temp_replace("user",$nickname,$page);
$page=temp_replace("spacer",$spacer,$page);
$page=temp_replace("gor",$click,$page);


?>
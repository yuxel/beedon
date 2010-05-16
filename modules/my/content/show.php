<?
$id=(int)$_GET['id'];
$getq=db_query("select * from ${dbprefix}my where myid='$id'");
if(db_num_rows($getq)>0){
@db_query("update ${dbprefix}my set counter=counter+1 where myid='$id'");  //sayacý arttýr
while($data=db_fetch_row($getq)){
$show=file_get_contents("$temp_dir/show.html");
$sout=temp_replace("mycontent",$data[2],$show);
$sout=temp_replace("time",$data[5],$sout);
$sout=temp_replace("sender",$data[3],$sout);
$sout=temp_replace("counter",$data[4],$sout);
$sout=temp_replace("tsender",_lang_sender,$sout);
$sout=temp_replace("tcounter",_lang_counter,$sout);
$sout=temp_replace("last_update",_lang_last_update,$sout);
}#while
$page=temp_replace("module",$sout,$page);
} #if
else{
$page=temp_replace("module",$msg_file,$page);
$page=temp_replace("msg",_lang_no_content,$page);
$page=temp_replace("if_not_forward","",$page);
}





?> 

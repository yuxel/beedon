<?
$own=file_get_contents("$mtemp_dir/own.html");
$page=temp_replace("content",$own,$page);
$page=temp_replace("add",_lang_add,$page);
$page=temp_replace("edit",_lang_edit,$page);

if(!$effect) $page=temp_replace("blkcont","",$page);
if($effect=="add"){  //yeni blok ekle
$add_own=file_get_contents("$mtemp_dir/add_own.html");
$page=temp_replace("blkcont",$add_own,$page);
$page=temp_replace("allowed_tags",_lang_allowed_tags,$page);
$page=temp_replace("name",_lang_name,$page);
$page=temp_replace("header",_lang_header,$page);
$page=temp_replace("blkcontent",_lang_content,$page);
$page=temp_replace("location",_lang_block_location,$page);
$page=temp_replace("submit_text",_lang_submit_text,$page);
$page=temp_replace("left",_lang_left,$page);
$page=temp_replace("right",_lang_right,$page);
$page=temp_replace("auth",_lang_access,$page);
$page=temp_replace("list_auth",list_auths(),$page);
} #effect=add

if($effect=="add_it"){  //gelen bilgilere göre ekle
//deðiþkenleri al
$name=htmlspecialchars($_POST['name']);
$header=htmlspecialchars($_POST['header']);
$blkcontent=htmlspecialchars($_POST['blkcontent']);
$loc=htmlspecialchars($_POST['loc']);
$nauth=htmlspecialchars($_POST['nauth']);

@db_query("insert into ${dbprefix}blocks (blockactive,header,content,name, auth, location) values ('1','$header','$blkcontent','$name','$nauth','$loc')");  //ekle
$page=temp_replace("blkcont",_lang_block_added,$page);
} #effect=add_it

if($effect=="edit"){   //kurulu blok listesini al
$ownq=@db_query("select * from ${dbprefix}blocks");
if(@db_num_rows($ownq)<1){
    $page=temp_replace("blkcont",_lang_no_own_blocks,$page);

} #if
else
{
    $edit_own=file_get_contents("$mtemp_dir/edit_own.html");
    $page=temp_replace("blkcont",$edit_own,$page);
    $page=temp_replace("name",_lang_name,$page);
    $page=temp_replace("edit",_lang_edit,$page);
    $page=temp_replace("remove",_lang_remove,$page);

    while($data=db_fetch_row($ownq)){
        $edit_but="<a href=\"?module=admin&a_module=block&action=own&effect=edit_it&id=$data[0]\"><img src=\"image/edit.png\"></a>";

        $remove_but="<a href=\"?module=admin&a_module=block&action=own&effect=remove_it&id=$data[0]\"><img src=\"image/delete.png\"></a>";

        $actionx.="<tr><td>$data[4]</td><td>$edit_but</td><td>$remove_but</td></tr>";

    } #while


    $page=temp_replace("action",$actionx,$page);
} #else
} #effect=edit


if($effect=="remove_it"){ //id'ye göre  kendi bloðunu sil
$id=$_GET['id'];
@db_query("delete from ${dbprefix}blocks where blid='$id'");
$page=temp_replace("blkcont",_lang_block_removed,$page);

} #effect=remove_it


if($effect=="edit_it"){  //gelen veriye göre bloðu düzenle
$id=$_GET['id'];
$edq=@db_query("select * from ${dbprefix}blocks where blid='$id'");
while($data=db_fetch_row($edq)){
    $blid=$data[0];
    $blockactive=$data[1];
    $header=$data[2];
    $content=$data[3];
    $name=$data[4];
    $bauth=$data[5];
    $location=$data[6];
} #while
if($blockactive=="1") $check_text="checked";
else $checked_text="";

$edit_it=file_get_contents("$mtemp_dir/edit_it.html");
$page=temp_replace("blkcont",$edit_it,$page);
$page=temp_replace("allowed_tags",_lang_allowed_tags,$page);
$page=temp_replace("xname",$name,$page);
$page=temp_replace("xheader",$header,$page);
$page=temp_replace("xcont",from_html($content),$page);
$page=temp_replace("name",_lang_name,$page);
$page=temp_replace("header",_lang_header,$page);
$page=temp_replace("blkcontent",_lang_content,$page);
$page=temp_replace("location",_lang_block_location,$page);
$page=temp_replace("submit_text",_lang_submit_text,$page);
$page=temp_replace("left",_lang_left,$page);
$page=temp_replace("right",_lang_right,$page);
$page=temp_replace("auth",_lang_access,$page);
$page=temp_replace("active",_lang_active,$page);
$page=temp_replace("list_auth",list_auths($bauth),$page);
$page=temp_replace("chktext",$check_text,$page);
$page=temp_replace("blid",$blid,$page);
if($location=="left"){
    $page=temp_replace("txtlf","selected",$page);
    $page=temp_replace("txtrg","",$page);
} #if

if($location=="right"){
    $page=temp_replace("txtrg","selected",$page);
    $page=temp_replace("txtlf","",$page);
} #iff


} #effect=add_it


if($effect=="update"){  //güncelle
$blid=htmlspecialchars($_POST['blid']);
$name=htmlspecialchars($_POST['name']);
$header=htmlspecialchars($_POST['header']);
$blkcontent=htmlspecialchars($_POST['blkcontent']);
$loc=htmlspecialchars($_POST['loc']);
$nauth=htmlspecialchars($_POST['nauth']);
$blkact=htmlspecialchars($_POST['blkact']);

if($blkact=="on") $blkact="1";
else $blkact="0";

@db_query("update ${dbprefix}blocks set blockactive='$blkact', header='$header', content='$blkcontent', name='$name',auth='$nauth', location='$loc' where blid='$blid'");
$page=temp_replace("blkcont",_lang_changes_applied,$page);
} #effect=update
?> 

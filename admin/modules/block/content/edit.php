<?
if(!$effect){ //dosya bloklarý düzenle

$modfile=file_get_contents("$mtemp_dir/$action.html");
$page=temp_replace("content",$modfile,$page);
$page=temp_replace("fname",_lang_file_name,$page);
$page=temp_replace("status",_lang_status,$page);
$page=temp_replace("install",_lang_install,$page);
$page=temp_replace("edit",_lang_edit,$page);
$page=temp_replace("remove",_lang_remove,$page);

$directory = "blocks/" ;  //blocks klasörü içindeki dosya bloklarý denetle
$ac = opendir($directory) ;

while($file = readdir($ac)){
    if ($file == ".." || $file == "."|| $file == "index.php" || $file == "index.html") continue;
    $f_php=explode(".",$file);

    $chech_if=db_query("SELECT * from ${dbprefix}module_blocks where file='$f_php[0]'");  //dosya veritabanýnda kurulu mu ?
    while($data=@db_fetch_row($chech_if)) {
        $blid=$data[0];
    }

    $installed_text=_lang_installed;
    $not_installed_text=_lang_not_installed;
    $inst_button="<a href=\"?module=admin&a_module=block&action=edit&effect=install&id=$f_php[0]\"><img src=\"image/blinstall.png\"></a>";
    $rem_button="<a href=\"?module=admin&a_module=block&action=edit&effect=remove&id=$blid\"><img src=\"image/delete.png\"></a>";
    $edit_button="<a href=\"?module=admin&a_module=block&action=edit&effect=edit&id=$blid\"><img src=\"image/edit.png\"></a>";

    if (db_num_rows($chech_if) == 0) {  //eðer kurulu deðil ise
    $actionx.="<tr><td>$f_php[0]</td><td>$not_installed_text</td><td>$inst_button</td><td></td><td></td></tr>";
    } #if

    else { //eðer kurulu ise
    $actionx.="<tr><td>$f_php[0]</td><td>$installed_text</td><td></td><td>$edit_button</td><td>$rem_button</td></tr>";
    }
} #while
closedir($ac);  //klasörü kapat
$page=temp_replace("action",$actionx,$page);
} # !effect

if($effect=="install"){ //kur
$fl=$_GET['id'];  //dosya adý
//dosya bloklarý kur
if(file_exists("blocks/".$fl.".php")) {
@db_query("delete from ${dbprefix}module_blocks where file='$fl'");
@db_query("insert into ${dbprefix}module_blocks (blockactive, name, file, auth, location) values ('1','$fl','$fl','1','right')");
$page=temp_replace("content",_lang_block_installed,$page);
} #if
else {
$page=temp_replace("content",$msgfile,$page);
$page=temp_replace("msg",_lang_no_such_block,$page);
$page=temp_replace("if_not_forward","",$page);

} #else


} #effect=install

if($effect=="remove"){ //kaldýr
$bid=$_GET['id']; //dosya adý
@db_query("delete from ${dbprefix}module_blocks where bid='$bid'");
$page=temp_replace("content",_lang_block_removed,$page);
} #effect=remove

if($effect=="edit"){ //dosya bloklarý düzenle
$num=$_GET['id'];

$blq=db_query("SELECT * from ${dbprefix}module_blocks where bid='$num'");  //blok bilgilerini al
while($data=@db_fetch_row($blq)){
    $blid=$data[0];
    $blkact=$data[1];
    $name=$data[2];
    $file=$data[3];
    $bauth=$data[4];
    $location=$data[5];

} #while

$edit_bl=file_get_contents("$mtemp_dir/edit_block.html");
$page=temp_replace("content",$edit_bl,$page);
$page=temp_replace("access",_lang_access,$page);
$page=temp_replace("location",_lang_block_location,$page);
$page=temp_replace("active",_lang_active,$page);
$page=temp_replace("submit_text",_lang_submit_text,$page);
if($blkact=="1") $check_text="checked";
else $check_text="";

$page=temp_replace("check_text",$check_text,$page);

if($location=="left") {
    $page=temp_replace("sel_left_text","selected",$page);
    $page=temp_replace("sel_right_text","",$page);
}

if($location=="right"){
    $page=temp_replace("sel_left_text","",$page);
    $page=temp_replace("sel_right_text","selected",$page);

}
$page=temp_replace("left",_lang_left,$page);
$page=temp_replace("right",_lang_right,$page);

$page=temp_replace("file",_lang_file,$page);
$page=temp_replace("header",_lang_header,$page);
$page=temp_replace("fname","blocks/$file.php",$page);
$page=temp_replace("headerx",$name,$page);
$page=temp_replace("bid",$blid,$page);

$page=temp_replace("list_degree",list_auths($bauth),$page);
} #effect=edit
if($effect=="update"){  //blok güncelle
$bid=$_POST['bid'];
$header=$_POST['header'];
$nauth=$_POST['nauth'];
$loc=$_POST['loc'];
$blact=$_POST['blact'];

if($blact=="on") $blact="1";
else $blact="0";

@db_query("update ${dbprefix}module_blocks set blockactive='$blact', name='$header', auth='$nauth', location='$loc' where bid='$bid'");

$page=temp_replace("content",_lang_changes_applied,$page);
}
?> 

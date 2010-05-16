<?
if(!$effect){
    $directory = "modules/" ;
    $ac = opendir($directory) ;
    while($file = readdir($ac))
    { if ($file == ".." || $file == "."|| $file == "index.php" || $file == "index.html") continue;

    $chech_if=db_query("SELECT * from ${dbprefix}modules where name='$file'");
    if ((db_num_rows($chech_if) == 0) AND file_exists("modules/$file/install.php")) {
        $count++;
        if(is_dir("modules/$file")) {
            $inst.="$file &nbsp;<a href=\"?module=admin&amp;a_module=modules&amp;action=install&amp;effect=install&amp;name=$file\">#foo#</a><br>";
        } #if

    }
    }
    closedir($ac);
    if($count>0){
        $xfile=file_get_contents("$mtemp_dir/install.html");
        $page=temp_replace("module_content",$xfile,$page);
        $page=temp_replace("inst",$inst,$page);
        $page=temp_replace("foo",_lang_install,$page);
    } #if
    else
    {
        $page=temp_replace("module_content",$msgfile,$page);
        $page=temp_replace("msg",_lang_no_module_to_install,$page);
        $page=temp_replace("if_not_forward","",$page);
    } #else

} #!effect

if($effect=="install"){
    $nm=$_GET['name'];

    if(!in_array($nm,$restricted_modules) and file_exists("modules/$nm/install.php")) {
    include_once "modules/$nm/install.php";
    @db_query("insert into ${dbprefix}modules (modactive,name,auth) values('1','$nm','1')");

    $page=temp_replace("module_content",$msgfile,$page);
    $install_text=str_replace("%s",_lang_module_edit,_lang_module_installed);
    $page=temp_replace("msg",$install_text,$page);
    $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
}
else {
$page=temp_replace("module_content",$msgfile,$page);
$page=temp_replace("msg",_lang_no_such_module,$page);
$page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);

} #else


} #effect=="install"
?> 

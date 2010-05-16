<?
if(!$effect){

    $mquery=db_query("SELECT * from ${dbprefix}modules where name!='users' AND name!='admin' AND name!='home' AND name!='stats'");
    if(db_num_rows($mquery)<1) {

        $page=temp_replace("module_content",$msgfile,$page);
        $page=temp_replace("msg",_lang_no_module_to_remove,$page);
        $page=temp_replace("if_not_forward",_lang_module_remove_info ,$page);

    }
    else
    {
        $xfile=file_get_contents("$mtemp_dir/remove.html");
        $page=temp_replace("module_content",$xfile,$page);
        $page=temp_replace("info_text",_lang_module_remove_info,$page);
        $page=temp_replace("hmod_name",_lang_module_name,$page);
        while($data=@db_fetch_row($mquery)){
            $text.="<tr><td>$data[2]</td><td><a href=\"?module=admin&amp;a_module=modules&amp;action=remove&amp;effect=del&amp;id=$data[2]\"><img alt=\"\" src=\"image/delete.png\"></a></td></tr>";
        }
        $page=temp_replace("text",$text,$page);
    }
} #!effect



if($effect=="del"){
    $gid=$_GET['id'];
    
    if(!in_array($gid,$restricted_modules) and file_exists("modules/$gid/remove.php")) {
    @db_query("delete from ${dbprefix}modules where name='$gid' AND name!='users' AND name!='admin' AND name!='home'");
    @db_query("delete from ${dbprefix}menu where related_module='$gid'");
    include "modules/$gid/remove.php";
    $page=temp_replace("module_content",$msgfile,$page);
    $page=temp_replace("msg",_lang_module_removed,$page);
    $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
    } #if
else {
$page=temp_replace("module_content",$msgfile,$page);
$page=temp_replace("msg",_lang_no_such_module,$page);
$page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);

} #else
} # effect=del
?> 

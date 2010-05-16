<?
if(!$effect){
    $q=@db_query("select * from ${dbprefix}menu order by priority asc");
    if(@db_num_rows($q) <0 ) $page=temp_replace("content",_lang_no_menu_entry,$page);
    else
    {
        $action_edit="?module=admin&amp;a_module=menu&amp;action=edit&amp;effect=edit_it";
        $action_delete="?module=admin&amp;a_module=menu&amp;action=edit&amp;effect=delete_it";
        while($data = @db_fetch_row($q)) {
            $mid=$data[0];
            $name=$data[1];
            $url=$data[2];
            $priox=$data[4];
            $msg.="<tr><td><form action=\"$action_edit\" method=\"post\"><input type=\"hidden\" name=\"m_id\" value=\"$mid\"><input type=\"text\" name=\"anchor\" value=\"$name\"></td>
<td><input type=\"text\" name=\"url\" value=\"$url\"></td><td><input type=\"text\" maxlength=\"2\" size=\"3\" name=\"priority\" value=\"$priox\"></td>
<td><input type=\"submit\" value=\""._lang_update."\"></form></td><td><form action=\"$action_delete\" method=\"post\"><input type=\"hidden\" name=\"m_id\" value=\"$mid\"><input type=\"submit\" value=\""._lang_delete."\"></form></td></tr>";
        }
        $fi=file_get_contents("$mtemp_dir/edit.html");
        $page=temp_replace("content",$fi,$page);
        $page=temp_replace("edit_menu",$msg,$page);
    } # else
} #!effect
//
if($effect=="delete_it"){
    $mid=$_POST['m_id'];
    @db_query("delete from ${dbprefix}menu where menuid='$mid'");
    $page=temp_replace("content",_lang_menu_deleted,$page);
} #effect= delete_it

if($effect="edit_it"){
    $url=$_POST['url'];
    $anchor=$_POST['anchor'];
    $mid=$_POST['m_id'];
    $prio=$_POST['priority'];

    @db_query("update ${dbprefix}menu set name='$anchor', url='$url',priority='$prio' where menuid='$mid'");
    $page=temp_replace("content",_lang_menu_updated,$page);

}


$page=temp_replace("name",_lang_name_to_display,$page);
$page=temp_replace("url",_lang_url,$page);
$page=temp_replace("update",_lang_update,$page);
$page=temp_replace("delete",_lang_delete,$page);

?>
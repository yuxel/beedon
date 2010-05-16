<?
$mquery=db_query("SELECT * from ${dbprefix}modules");
if(!$effect){
    $xfile=file_get_contents("$mtemp_dir/edit.html");
    $page=temp_replace("module_content",$xfile,$page);
    $page=temp_replace("hmod_name",_lang_module_name,$page);
    $page=temp_replace("hmod_auth",_lang_auth,$page);
    $page=temp_replace("hmod_active",_lang_module_active,$page);

    while($data=@db_fetch_row($mquery)){
        if($data[1]=="1") $checktext="checked";
        else $checktext="";
        $text.="<tr><form action=\"?module=admin&amp;a_module=modules&amp;action=edit&amp;effect=update&amp;id=$data[0]\"
method=\"post\"><td>$data[2]</td><td> <input type=\"checkbox\" name=\"mactive\" $checktext></td>
<td>".list_auths($data[3])."</td><td><input type=\"submit\" value=\"#subtext#\"></td></form></tr>";

    }
    $page=temp_replace("text",$text,$page);

    $page=temp_replace("subtext",_lang_submit_text,$page);

} #!$effect
if($effect=="update"){
    $mid=$_GET['id'];
    $mauth=$_POST['nauth'];
    $mactive=$_POST['mactive'];
    if($mactive=="on") $mactive=1;
    else $mactive=0;
    db_query("update ${dbprefix}modules set modactive='$mactive', auth='$mauth' where mid='$mid'");
    $page=temp_replace("module_content",$msgfile,$page);
    $page=temp_replace("msg",_lang_changes_applied,$page);
    $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
    $page=forward($back,2,$page);


} #effect=update

?> 

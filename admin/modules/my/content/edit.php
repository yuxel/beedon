<?
if(!$effect){
    $ltemp=file_get_contents("$mtemp_dir/list.html");
    $lquery=db_query("select * from ${dbprefix}my");
    if(db_num_rows($lquery)<1) {
        $page=temp_replace("content",$msgfile,$page);
        $page=temp_replace("msg",_lang_no_content,$page);
        $page=temp_replace("if_not_forward","",$page);
    }
    else{
        while ($data=db_fetch_row($lquery)) {
            $lotemp=file_get_contents("$mtemp_dir/list_item.html");
            $lout=temp_replace("id",$data[0],$lotemp);
            $lout=temp_replace("name",$data[1],$lout);
            $lxout.=$lout;
        }
        $lxout=temp_replace("edit_text",_lang_edit,$lxout);
        $lxout=temp_replace("remove_text",_lang_remove,$lxout);
        $listout=temp_replace("list_item",$lxout,$ltemp);
        $page=temp_replace("content",$listout,$page);
    } #else
} #!effect

if($effect=="remove_it"){
    $id=$_GET['id'];
    $sq=db_query("select * from ${dbprefix}my where myid='$id'");
    if(db_num_rows($sq)<1) {
        $page=temp_replace("content",$msgfile,$page);
        $page=temp_replace("msg",_lang_no_such_content,$page);
        $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
        $page=forward($back,2,$page);
    }
    else{
        @db_query("delete from ${dbprefix}my where myid='$id'");
        $page=temp_replace("content",$msgfile,$page);
        $page=temp_replace("msg",_lang_content_removed,$page);
        $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
    }

} #effect=="delete_it"


if($effect=="edit_it"){
    $id=$_GET['id'];
    $sq=db_query("select * from ${dbprefix}my where myid='$id'");
    if(db_num_rows($sq)<1) {
        $page=temp_replace("content",$msgfile,$page);
        $page=temp_replace("msg",_lang_no_such_content,$page);
        $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
        $page=forward($back,2,$page);
    }
    else{
        $editittemp=file_get_contents("$mtemp_dir/edit_it.html");
        $page=temp_replace("content",$editittemp,$page);
        while($data=db_fetch_row($sq)){
            $page=temp_replace("sender",_lang_sender,$page);
            $page=temp_replace("time",_lang_time,$page);
            $page=temp_replace("header",_lang_header,$page);
            $page=temp_replace("ncontent",_lang_content,$page);
            $page=temp_replace("allowed_tags",_lang_allowed_tags,$page);
            $page=temp_replace("id",$data[0],$page);
            $page=temp_replace("getheader",$data[1],$page);
            $page=temp_replace("gettime",get_date()." ".get_time(),$page);
            $page=temp_replace("nsender",$data[3],$page);
            $page=temp_replace("getcontent",$data[2],$page);
            $page=temp_replace("submit_text",_lang_submit_text,$page);
        } #while
    } #else

} #effect==edit_it
if($effect=="update"){
    $id=(int)$_POST['myid'];
    $name=htmlspecialchars($_POST['header']);
    $content=$_POST['mycontent'];
    $sender=htmlspecialchars($_POST['sender']);
    $time=get_date()." ".get_time();
    $sq=db_query("select * from ${dbprefix}my where myid='$id'");
    if(db_num_rows($sq)<1) {
        $page=temp_replace("content",$msgfile,$page);
        $page=temp_replace("msg",_lang_no_such_content,$page);
        $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
        $page=forward($back,2,$page);
    }
    else{
        db_query("update ${dbprefix}my set name='$name',content='$content',sender='$sender',time='$time' where myid='$id'");
        $page=temp_replace("content",$msgfile,$page);
        $page=temp_replace("msg",_lang_changes_applied,$page);
        $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
    } #else

} #effect=update

?> 

<?

if(!$effect) {
    $xfile=file_get_contents("$mtemp_dir/setup.html");
    $page=temp_replace("module_content",$xfile,$page);

    $page=temp_replace("tnperpage",_lang_tnperpage,$page);
    $page=temp_replace("comments_on",_lang_comments_on,$page);
    $page=temp_replace("submit_text",_lang_submit_text,$page);
    $setupq=@db_query("select * from ${dbprefix}news_setup");
    while($data=@db_fetch_row($setupq)){
        $news_per_page=$data[0];
        $comment_on=$data[1];
        $comment_type=$data[2];
    }
    if($comment_on=="1") $check_text="checked";
    else $check_text="";
    $page=temp_replace("newsperpage",$news_per_page,$page);
    $page=temp_replace("check_text",$check_text,$page);
} #!effect

if($effect=="update"){
    $nperpage=(int)$_POST['nperpage'];
    $comment_on=$_POST['comment_on'];

    if($comment_on=="on") $comment_on="1";
    else $comment_on="0";
    @db_query("update ${dbprefix}news_setup set news_per_page='$nperpage', comments_on='$comment_on'");
    $page=temp_replace("module_content",$msgfile,$page);
    $page=temp_replace("msg",_lang_changes_applied,$page);
    $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
    $page=forward($back,2,$page);
} #effect=update






?>
<?
if(!$effect){
    $page=temp_replace("content",$start,$page);
    $page=temp_replace("info_text",_lang_startadmin_info,$page);
    $page=temp_replace("module_on_page",_lang_start_module_on_page,$page);
    $page=temp_replace("which_module",_lang_start_which_module,$page);
    $page=temp_replace("msg_on_page",_lang_start_msg_on_page,$page);
    $page=temp_replace("header",_lang_header,$page);
    $page=temp_replace("submit_text",_lang_submit_text,$page);
    $page=temp_replace("msg_text",_lang_msg_content,$page);
    $page=temp_replace("html_allowed",_lang_allowed_tags,$page);
    //
    $query=@db_query("select * from ${dbprefix}start_page");
    while($data = @db_fetch_row($query)){
        $comment_on=$data[0];
        $header=$data[1];
        $contentx=$data[2];
        $module_on=$data[3];
        $modulex=$data[4];
    }

    if($comment_on=="1") $comment_on_text=_lang_yes;
    else $comment_on_text=_lang_no;

    if($module_on=="1") $module_on_text=_lang_yes;
    else $module_on_text=_lang_no;

    function module_yes_no($selected=0){
        if($selected=="1") $sel1="selected";
        else $sel1="";
        if($selected=="0") $sel0="selected";
        else $sel0="";

        return $msg="<select name=\"module_yes_no\">
	<option $sel0 value=\"0\">"._lang_no."
	<option $sel1 value=\"1\">"._lang_yes."
	</select>";
    } #module_yes_no

    function list_active_modules($selected="users"){
        $dbprefix=$GLOBALS['dbprefix'];
        $q=@db_query("select name from ${dbprefix}modules where auth<3 and modactive='1' and name!='home'");
        $for=@db_num_rows($q);
        $msg="<select name=\"which_module\">";
        while($data=@db_fetch_row($q)){
            if($selected==$data[0]) $text="selected";
            else $text="";
            $msg.="<option $text value=\"$data[0]\">$data[0]";
        } #while
        $msg.="</select>";
        return $msg;
    } #list_active_modules


    function comment_yes_no($selected=0){
        if($selected=="1") $sel1="selected";
        else $sel1="";
        if($selected=="0") $sel0="selected";
        else $sel0="";

        return $msg="<select name=\"comment_yes_no\">
	<option $sel0 value=\"0\">"._lang_no."
	<option $sel1 value=\"1\">"._lang_yes."
	</select>";
    } #content_yes_no
    //
    $page=temp_replace("list_active_modules",list_active_modules($modulex),$page);
    $page=temp_replace("mod_on_page_yes_no",module_yes_no($module_on),$page);
    $page=temp_replace("get_msg_on_page_val",comment_yes_no($comment_on),$page);
    $page=temp_replace("header_val",$header,$page);
    $page=temp_replace("textarea_val",from_html($contentx),$page);

} #!effect
?> 

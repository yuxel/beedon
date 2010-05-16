<?
if(!$effect){
    $fi=file_get_contents("$mtemp_dir/add.html");
    $page=temp_replace("content",$fi,$page);
    $page=temp_replace("sender",_lang_sender,$page);
    $page=temp_replace("time",_lang_time,$page);
    $page=temp_replace("header",_lang_name,$page);
    $page=temp_replace("ncontent",_lang_content,$page);
    $page=temp_replace("nsender",$bee_name,$page);
    $page=temp_replace("gettime",get_date()." ".get_time(),$page);
    $page=temp_replace("html_allowed",_lang_html_allowed,$page);
    $page=temp_replace("submit_text",_lang_submit_text,$page);
} #!effect

if($effect=="add_it"){
    $time=$_POST['time'];
    $header=htmlspecialchars($_POST['header']);
    $mycontent=$_POST['mycontent'];
    $sender=$bee_name;
    if((!$header) OR (!$mycontent)) {
        $page=temp_replace("content",_lang_no_blank_input,$page);
    }
    else
    {
        @db_query("insert into ${dbprefix}my (name,content,sender,counter,time) values('$header','$mycontent','$bee_name','1','$time')");
        $page=temp_replace("content",_lang_content_added,$page);

    }
} #effect=add_it
?> 

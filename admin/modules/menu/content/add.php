  
<?
if(!$effect){
    $fi=file_get_contents("$mtemp_dir/add.html");
    $page=temp_replace("content",$fi,$page);
    $page=temp_replace("anchor",_lang_name_to_display,$page);
    $page=temp_replace("url",_lang_url,$page);
    $page=temp_replace("submit_text",_lang_submit_text,$page);
} #!effect

if($effect=="add_it"){
    $url=$_POST['url'];
    $anchor=$_POST['anchor'];

    @db_query("insert into ${dbprefix}menu (name,url,priority) values ('$anchor','$url','99')");
    $page=temp_replace("content",_lang_menu_added,$page);

} #effect=add_it
?> 

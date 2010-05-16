<?
/*------------------------
haber yönetim modülü
-----------------------*/

$topics_image="image/topics/";  //konu resimleri
$xfile=file_get_contents("$mtemp_dir/news.html");  //haberler için template dosyasý
$page=temp_replace("module_content",$xfile,$page);
$page=temp_replace("add",_lang_add,$page);
$page=temp_replace("edit_remove",_lang_edit_remove,$page);
$page=temp_replace("mark",_lang_mark_news,$page);


if(!$effect){  //efect yoksa biþey yazma
$page=temp_replace("module_content","",$page);

} #!$effect

if($effect=="add"){  //haber ekle
$stemp=file_get_contents("$mtemp_dir/send_news.html");
if($GLOBALS['bee_name']!="beeman") $sender=$GLOBALS['bee_name'];
else $sender=_lang_anonymous;  //eðer ziyretci ise

$page=temp_replace("module_content",$stemp,$page);
$page=temp_replace("sender",_lang_sender,$page);
$page=temp_replace("time",_lang_date,$page);
$page=temp_replace("header",_lang_header,$page);
$page=temp_replace("topic",_lang_topic,$page);
$page=temp_replace("news",_lang_content,$page);
$page=temp_replace("allowed_tags",_lang_allowed_tags,$page);
$page=temp_replace("submit_text",_lang_submit_text,$page);
$page=temp_replace("user",$sender,$page);
$page=temp_replace("date",get_date()." ".get_time(),$page);
$page=temp_replace("list_topics",list_topics(),$page);
$page=temp_replace("preview_text",_lang_preview,$page);

} #effect=add

if($effect=="preview"){
    $sender=htmlspecialchars($_POST['sender']);
    $senddate=htmlspecialchars($_POST['senddate']);
    $nheader=htmlspecialchars($_POST['nheader']);
    $topic=htmlspecialchars($_POST['topic']);
    $ncontent=htmlspecialchars($_POST['ncontent']);

    if(!$nheader OR !$ncontent) { //eðer baþlýk veya haber yoksa
    $page=temp_replace("module_content",$msgfile,$page);
    $page=temp_replace("msg",_lang_no_header_or_content,$page);
    $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
    $page=forward($back,2,$page);
    } #if
    else
    {
$stemp=file_get_contents("$mtemp_dir/preview_id.html");
if($GLOBALS['bee_name']!="beeman") $sender=$GLOBALS['bee_name'];
else $sender=_lang_anonymous;  //eðer ziyretci ise


$page=temp_replace("module_content",$stemp,$page);

$page=temp_replace("sender",_lang_sender,$page);
$page=temp_replace("time",_lang_date,$page);
$page=temp_replace("header",_lang_header,$page);
$page=temp_replace("topic",_lang_topic,$page);
$page=temp_replace("news",_lang_content,$page);
$page=temp_replace("allowed_tags",_lang_allowed_tags,$page);
$page=temp_replace("submit_text",_lang_submit_text,$page);
$page=temp_replace("user",$sender,$page);
$page=temp_replace("date",get_date()." ".get_time(),$page);
$page=temp_replace("list_topics",list_topics($topic),$page);
$page=temp_replace("preview_text",_lang_preview,$page);

$topicQuery=@db_query("select image from ${dbprefix}news_topics where tid='$topic'");
while($tlogo=db_fetch_row($topicQuery)){
$topicLogo="image/topics/".$tlogo[0];
}

$exptime=explode(" ",$senddate);
$hour=$exptime[1];
$expdate=explode("-",$exptime[0]);
$year=$expdate[0];
$month=$expdate[1];
$day=$expdate[2];
$dayname=return_dayname($year,$month,$day);    

$page=temp_replace("prev_header","$nheader",$page);
$page=temp_replace("prev_news",to_html($ncontent,1),$page);
$page=temp_replace("prev_news_textarea",stripslashes($ncontent),$page);
$page=temp_replace("prev_topic_logo","$topicLogo",$page);
$page=temp_replace("prev_date","$senddate",$page);
$page=temp_replace("prev_day",$day,$page);
$page=temp_replace("prev_month",$month,$page);
$page=temp_replace("prev_year",$year,$page);
$page=temp_replace("prev_hour",$hour,$page);
$page=temp_replace("prev_dayname",$dayname,$page);
$page=temp_replace("prev_month_name",return_month_name((int)$month),$page);






       $page=temp_replace("module_content",$msgfile,$page);
        $page=temp_replace("msg",_lang_news_added,$page);
        $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
        //$page=forward($back,2,$page);
    } #else
} #effect=preview





elseif($effect=="add_it"){
    //gelen haberi ekle
    $sender=htmlspecialchars($_POST['sender']);
    $senddate=htmlspecialchars($_POST['senddate']);
    $nheader=htmlspecialchars($_POST['nheader']);
    $topic=htmlspecialchars($_POST['topic']);
    $ncontent=htmlspecialchars($_POST['ncontent']);

    if(!$nheader OR !$ncontent) { //eðer baþlýk veya haber yoksa
    $page=temp_replace("module_content",$msgfile,$page);
    $page=temp_replace("msg",_lang_no_header_or_content,$page);
    $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
    $page=forward($back,2,$page);
    } #if
    else
    {
        global $bee_name;
        @db_query("insert into ${dbprefix}news (header,content,sender,topic,counter,time,editor) values ('$nheader','$ncontent','$sender','$topic','1','$senddate','$bee_name')");  //haber güncelle ve editor olarak kullanýcý ata
        $page=temp_replace("module_content",$msgfile,$page);
        $page=temp_replace("msg",_lang_news_added,$page);
        $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
        $page=forward("?module=home",2,$page);
    } #else
} #effect add_it

elseif($effect=="edit"){  //düzenlenebilecek haber listesi
$topq=@db_query("select * from ${dbprefix}news where editor is not null order by nid desc");
if(db_num_rows($topq)<1){
    $page=temp_replace("module_content",$msgfile,$page);
    $page=temp_replace("msg",_lang_no_news,$page);
    $page=temp_replace("if_not_forward","",$page);
}
else{
    $editnews=file_get_contents("$mtemp_dir/listtemp.html");
    $page=temp_replace("module_content",$editnews,$page);
    $etemp=file_get_contents("$mtemp_dir/list.html");

    while($data=db_fetch_row($topq)){
        $etemp=file_get_contents("$mtemp_dir/list.html");
        $edit_module="&amp;effect=lookedit&amp;id=$data[0]";
        $remove_module="&amp;effect=delete_it&amp;id=$data[0]";
        $etemp=temp_replace("name",$data[1],$etemp);
        $etemp=temp_replace("edit",_lang_look,$etemp);
        $etemp=temp_replace("delete",_lang_remove,$etemp);
        $etemp=temp_replace("edit_module",$edit_module,$etemp);
        $etemp=temp_replace("remove_module",$remove_module,$etemp);

        $out.=$etemp;
    } #while
    $page=temp_replace("contentx",$out,$page);
}
} #effect=edit

elseif($effect=="mark"){  //onaylanabilecek haber listesi
$topq=@db_query("select * from ${dbprefix}news where editor is null order by nid desc");
if(db_num_rows($topq)<1){
    $page=temp_replace("module_content",$msgfile,$page);
    $page=temp_replace("msg",_lang_no_news,$page);
    $page=temp_replace("if_not_forward","",$page);
}
else{
    $editnews=file_get_contents("$mtemp_dir/listtemp.html");
    $page=temp_replace("module_content",$editnews,$page);
    $etemp=file_get_contents("$mtemp_dir/list.html");

    while($data=db_fetch_row($topq)){
        $etemp=file_get_contents("$mtemp_dir/list.html");
        $edit_module="&amp;effect=lookmark&amp;id=$data[0]";
        $remove_module="&amp;effect=delete_it&amp;id=$data[0]";
        $etemp=temp_replace("name",$data[1],$etemp);
        $etemp=temp_replace("edit",_lang_look,$etemp);
        $etemp=temp_replace("delete",_lang_remove,$etemp);
        $etemp=temp_replace("edit_module",$edit_module,$etemp);
        $etemp=temp_replace("remove_module",$remove_module,$etemp);

        $out.=$etemp;
    } #while
    $page=temp_replace("contentx",$out,$page);
}
} #effect=edit


elseif($effect=="delete_it"){  //haber sil
$id=$_GET['id'];  //numara al
$delq=db_query("select nid from ${dbprefix}news where nid='$id'");
if(db_num_rows($delq)<1){  //eðer silinecek haber yoksa
$page=temp_replace("module_content",$msgfile,$page);
$page=temp_replace("msg",_lang_no_news,$page);
$page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
$page=forward($back,2,$page);
} #if
else{
    $page=temp_replace("module_content",$msgfile,$page);
    $page=temp_replace("msg",_lang_news_deleted,$page);
    $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
    $page=forward($back,2,$page);
    db_query("delete from ${dbprefix}news where nid='$id'");
} #else

} #effect delet_it

elseif($effect=="lookmark"){  //onalyanacak haber göz at
$id=$_GET['id'];  //numara al
$markq=db_query("select * from ${dbprefix}news where nid='$id'");  //sorgu
if(db_num_rows($markq)<1){ //haber yoksa
$page=temp_replace("module_content",$msgfile,$page);
$page=temp_replace("msg",_lang_no_news,$page);
$page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
$page=forward($back,2,$page);
} #if
else
{
    $out=write_news_content($markq,0,1);   //modules/$a_module/include/functions.php"
    $markfooter=@file_get_contents("$mtemp_dir/markit.html");
    $markfooter=temp_replace("look",_lang_look,$markfooter);
    $markfooter=temp_replace("mark",_lang_mark,$markfooter);
    $markfooter=temp_replace("newsid",$id,$markfooter);
    $markfooter=temp_replace("delete",_lang_delete,$markfooter);
    $out.=$markfooter;
    $page=temp_replace("module_content",$out,$page);
} #else
} #effect look_mark



elseif($effect=="lookedit"){  //düzenlenecek haber göz at
$id=$_GET['id'];  //numara al

$editq=@db_query("select nid,header,content,sender,topic,editor,counter,time,image from ${dbprefix}news, ${dbprefix}news_topics where ${dbprefix}news.topic=${dbprefix}news_topics.tid and nid='$id' order by nid"); //sorgu



if(db_num_rows($editq)<1){  //eðer yoksa
$page=temp_replace("module_content",$msgfile,$page);
$page=temp_replace("msg",_lang_no_news,$page);
$page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
$page=forward($back,2,$page);
} #if
else
{


    $out=write_news_content($editq,0,1); //modules/$a_module/include/functions.php"
    $editfooter=@file_get_contents("$mtemp_dir/editit.html");
    $editfooter=temp_replace("edit",_lang_edit,$editfooter);
    $editfooter=temp_replace("newsid",$id,$editfooter);
    $editfooter=temp_replace("delete",_lang_delete,$editfooter);
    $out.=$editfooter;
    $page=temp_replace("module_content",$out,$page);
} #else
} #effect look_mark



elseif($effect=="mark_it"){  //haberi onayla
$id=$_GET['id'];  //numara al
$editit=db_query("select * from ${dbprefix}news where nid='$id'");
if(db_num_rows($editit)<1){ //haber varsa
$page=temp_replace("module_content",$msgfile,$page);
$page=temp_replace("msg",_lang_no_news,$page);
$page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
$page=forward($back,2,$page);
} #if
else
{
    $page=temp_replace("module_content",$msgfile,$page);
    $page=temp_replace("msg",_lang_news_marked,$page);
    $page=temp_replace("if_not_forward","",$page);
    global $bee_name;
    @db_query("update ${dbprefix}news set editor='$bee_name' where nid='$id'");  //onayla
}





}

elseif($effect=="edit_it"){  //haberi düzenle
$id=$_GET['id'];  //numara al
$editit=db_query("select * from ${dbprefix}news where nid='$id'");
if(db_num_rows($editit)<1){  //varmý yok mu ?
$page=temp_replace("module_content",$msgfile,$page);
$page=temp_replace("msg",_lang_no_news,$page);
$page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
$page=forward($back,2,$page);
} #if
else
{
    while($data=db_fetch_row($editit)){
        //template dosyasýna deðiþkenleri yaz ve update_it'e gönder
        $edfile=file_get_contents("$mtemp_dir/edit_news.html");
        $out=$edfile;
        global $bee_name;
        $out=temp_replace("sender",_lang_sender,$out);
        $out=temp_replace("time",_lang_time,$out);
        $out=temp_replace("editor",_lang_editor,$out);
        $out=temp_replace("topic",_lang_topic,$out);
        $out=temp_replace("news",_lang_content,$out);
        $out=temp_replace("user",$data[3],$out);
        $out=temp_replace("date",$data[7],$out);
        $out=temp_replace("geditor",$bee_name,$out);
        $out=temp_replace("header",_lang_header,$out);
        $out=temp_replace("gheader",$data[1],$out);
        $out=temp_replace("list_topics",list_topics($data[4]),$out);
        $out=temp_replace("allowed_tags",_lang_allowed_tags,$out);
        $out=temp_replace("submit_text",_lang_submit_text,$out);
        $out=temp_replace("newsid",$data[0],$out);
        $out=temp_replace("gtext",from_html($data[2]),$out);
        $out=temp_replace("",_lang,$out);
        $out=temp_replace("",_lang,$out);
        $out=temp_replace("",_lang,$out);
    }
    $page=temp_replace("module_content",$out,$page);
$page=temp_replace("preview_text",_lang_preview,$page);
} #else
}

elseif($effect=="updateit"){//gelen haberi güncelle
//bilgileri al
if($_POST['id']) $newsid=(int)$_POST['id'];
else if($_GET['id']) $newsid=(int)$_GET['id'];

$editor=htmlspecialchars($_POST['editor']);
$nheader=htmlspecialchars($_POST['nheader']);
$ncontent=htmlspecialchars($_POST['ncontent']);
$topic=htmlspecialchars($_POST['topic']);
$updateit=db_query("select * from ${dbprefix}news where nid='$newsid'");
if(db_num_rows($updateit)<1){ //haber var mý ?
$page=temp_replace("module_content",$msgfile,$page);
$page=temp_replace("msg",_lang_no_news,$page);
$page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
$page=forward($back,2,$page);
} #if
else
{
    $page=temp_replace("module_content",$msgfile,$page);
    $page=temp_replace("msg",_lang_changes_applied,$page);
    $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
    db_query("update ${dbprefix}news set header='$nheader', content='$ncontent', topic='$topic', editor ='$editor' where nid='$newsid'");  //gelen verilere göre haberi güncelle
} #else
} #effect updateit



else if($effect=="update_preview"){

if($_POST['id']) $newsid=(int)$_POST['id'];
else if($_GET['id']) $newsid=(int)$_GET['id'];

$editor=htmlspecialchars($_POST['editor']);
$nheader=htmlspecialchars($_POST['nheader']);
$ncontent=htmlspecialchars($_POST['ncontent']);
$topic=htmlspecialchars($_POST['topic']);
$senddate=htmlspecialchars($_POST['senddate']);

$stemp=file_get_contents("$mtemp_dir/preview_id_update.html");

if(!$nheader OR !$ncontent) { //eðer baþlýk veya haber yoksa
    $page=temp_replace("module_content",$msgfile,$page);
    $page=temp_replace("msg",_lang_no_header_or_content,$page);
    $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
    $page=forward($back,2,$page);
    } #if
    else

if($GLOBALS['bee_name']!="beeman") $sender=$GLOBALS['bee_name'];
else $sender=_lang_anonymous;  //eðer ziyretci ise


$page=temp_replace("module_content",$stemp,$page);

$page=temp_replace("sender",_lang_sender,$page);
$page=temp_replace("time",_lang_date,$page);
$page=temp_replace("header",_lang_header,$page);
$page=temp_replace("topic",_lang_topic,$page);
$page=temp_replace("news",_lang_content,$page);
$page=temp_replace("allowed_tags",_lang_allowed_tags,$page);
$page=temp_replace("submit_text",_lang_submit_text,$page);
$page=temp_replace("user",$sender,$page);
$page=temp_replace("date",$senddate,$page);
$page=temp_replace("list_topics",list_topics($topic),$page);
$page=temp_replace("preview_text",_lang_preview,$page);


$topicQuery=@db_query("select image from ${dbprefix}news_topics where tid='$topic'");
while($tlogo=db_fetch_row($topicQuery)){
$topicLogo="image/topics/".$tlogo[0];
}

$exptime=explode(" ",$senddate);
$hour=$exptime[1];
$expdate=explode("-",$exptime[0]);
$year=$expdate[0];
$month=$expdate[1];
$day=$expdate[2];
$dayname=return_dayname($year,$month,$day);    

$page=temp_replace("prev_header","$nheader",$page);
$page=temp_replace("prev_news",to_html($ncontent,1),$page);
$page=temp_replace("prev_news_textarea",stripslashes($ncontent),$page);
$page=temp_replace("prev_topic_logo","$topicLogo",$page);
$page=temp_replace("prev_date","$senddate",$page);
$page=temp_replace("prev_day",$day,$page);
$page=temp_replace("prev_month",$month,$page);
$page=temp_replace("prev_year",$year,$page);
$page=temp_replace("prev_hour",$hour,$page);
$page=temp_replace("prev_dayname",$dayname,$page);
$page=temp_replace("prev_month_name",return_month_name((int)$month),$page);
$page=temp_replace("id",$newsid,$page);





       $page=temp_replace("module_content",$msgfile,$page);
        $page=temp_replace("msg",_lang_news_added,$page);
        $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
        //$page=forward($back,2,$page);
} #update_preview








else $page=temp_replace("module_content",_lang_module_not_exists,$page);  //eðer bilinmeyen bir $action ise
?>
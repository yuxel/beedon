<?
$xfile=file_get_contents("$mtemp_dir/topics.html");
$page=temp_replace("module_content",$xfile,$page);
$page=temp_replace("add",_lang_add,$page);
$page=temp_replace("edit_remove",_lang_edit_remove,$page);

if(!$effect) $page=temp_replace("module_content","",$page);
if($effect=="edit"){
    $path="image/topics";
    $counter=1;
    $total_count=0;
    $topq=@db_query("select * from ${dbprefix}news_topics");
    if(@db_num_rows($topq)<1) $page=temp_replace("module_content",_lang_no_topic,$page);
    $topn=@db_num_rows($topq);
    $topictemp=file_get_contents("$mtemp_dir/list_topics.html");
    $page=temp_replace("module_content",$topictemp,$page);
    $page=temp_replace("topics",_lang_topics,$page);
    $to=ceil($topn/4);
    $msg="<tr>";
    $togo=htmlspecialchars("?module=admin&a_module=news&action=topics");

    while($data=@db_fetch_row($topq)){
        $image="<img style=\"width:32;height:32\" src=\"$path/$data[3]\" alt=\"\"><br>$data[2]<br><br><a href=\"$togo&amp;effect=edit_it&amp;id=$data[0]\">#edit#</a>&nbsp; &nbsp;<a href=\"$togo&amp;effect=remove_it&amp;id=$data[0]\">#remove#</a>";
        if($counter<5){
            $msg.="<td>$image</td>";
        } #if
        if($counter==5){
            $msg.="</tr><tr><td>$image</td>";
            $counter=0;
        } #if
        $counter++;
    } #while
    $msg.="</tr>";
    $page=temp_replace("topic_list",$msg,$page);
    $page=temp_replace("edit",_lang_edit,$page);
    $page=temp_replace("remove",_lang_remove,$page);

} #effect=edit




if($effect=="edit_it"){
    $id=$_GET['id'];
    $topicq=@db_query("select * from ${dbprefix}news_topics where tid=$id");
    if((db_num_rows($topicq)<1) OR !$id) $page=temp_replace("module_content",_lang_no_such_topic,$page);
    else{

        $efile=file_get_contents("$mtemp_dir/edit_topic.html");
        $page=temp_replace("module_content",$efile,$page);
        $page=temp_replace("name",_lang_name,$page);
        $page=temp_replace("description",_lang_description,$page);
        $page=temp_replace("image",_lang_image,$page);
        $page=temp_replace("list_images",popup("admin/modules/$a_module/content/list_images.php",_lang_list_images),$page);
        $page=temp_replace("upload_dialog",popup("admin/modules/$a_module/content/upload_image.php",_lang_upload_images),$page);
        while($data=@db_fetch_row($topicq)){
            $tid=$data[0];
            $name=$data[1];
            $desc=$data[2];
            $img=$data[3];
            $image="<img src=\"$impath/$img\" alt=\"\" style=\"width:32;height:32\">";
        } #while
        $page=temp_replace("timage",$image."<br>".select_image($impath,$img),$page);
        $page=temp_replace("tdesc",$desc,$page);
        $page=temp_replace("tname",$name,$page);
        $page=temp_replace("tid",$tid,$page);
        $page=temp_replace("submit_text",_lang_submit_text,$page);

    } #else
} #effect=edit_it


if($effect=="remove_it"){
    $id=$_GET['id'];
    $topicq=@db_query("select * from ${dbprefix}news_topics where tid=$id");
    if((db_num_rows($topicq)<1) OR !$id) $page=temp_replace("module_content",_lang_no_such_topic,$page);
    else{
        @db_query("delete from ${dbprefix}news_topics where tid='$id'");
        $efile=file_get_contents("$mtemp_dir/msg.html");
        $page=temp_replace("module_content",$efile,$page);
        $page=temp_replace("msg",_lang_topic_deleted,$page);
        $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
        $page=forward($back,2,$page);
    } #else
} #effect=remove

if($effect=="update_topic"){
    $id=$_GET['id'];
    $tname=$_POST['tname'];
    $tdesc=$_POST['tdesc'];
    $image=$_POST['image'];

    $topicq=@db_query("select * from ${dbprefix}news_topics where tid=$id");
    if((db_num_rows($topicq)<1) OR !$id) $page=temp_replace("module_content",_lang_no_such_topic,$page);
    else{
        @db_query("update ${dbprefix}news_topics set name='$tname',description='$tdesc',image='$image' where tid='$id'");
        $efile=file_get_contents("$mtemp_dir/msg.html");
        $page=temp_replace("module_content",$efile,$page);
        $page=temp_replace("msg",_lang_changes_applied,$page);
        $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
        $page=forward($back,2,$page);


    } #else

} #effect=update_topic



if($effect=="add"){
    $efile=file_get_contents("$mtemp_dir/add_topic.html");
    $page=temp_replace("module_content",$efile,$page);
    $page=temp_replace("name",_lang_name,$page);
    $page=temp_replace("description",_lang_description,$page);
    $page=temp_replace("image",_lang_image,$page);
    $page=temp_replace("list_images",popup("admin/modules/$a_module/content/list_images.php",_lang_list_images),$page);
    $page=temp_replace("upload_dialog",popup("admin/modules/$a_module/content/upload_image.php",_lang_upload_images),$page);
    $page=temp_replace("timage",select_image($impath,$img),$page);
    $page=temp_replace("submit_text",_lang_submit_text,$page);
} #effect=add


if($effect=="add_topic"){
    $tname=$_POST['tname'];
    $tdesc=$_POST['tdesc'];
    $image=$_POST['image'];
    @db_query("insert into ${dbprefix}news_topics (name,description,image) values('$tname','$tdesc','$image')");
    $efile=file_get_contents("$mtemp_dir/msg.html");
    $page=temp_replace("module_content",$efile,$page);
    $page=temp_replace("msg",_lang_topic_added,$page);
    $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
    $page=forward($back,2,$page);

} #effect=add_topic
?>
<?
if($effect=="null"){
  $temp_act=file_get_contents("$temp_dir/activate.html");
  $page=temp_replace("content",$temp_act,$page);
  $page=temp_replace("username",_lang_nick,$page);
  $page=temp_replace("actcode",_lang_activation_code,$page);
  $page=temp_replace("submit_text",_lang_submit_text,$page);
}

if($effect=="check") {
  $user=$_POST['user'];
  $code=$_POST['code'];
  if(($user) and ($code)) {
    $actq=@db_query("select * from ${dbprefix}members where nick='$user' and activation_code='$code'");

    $page=temp_replace("content",$msg_file,$page);
    if(db_num_rows($actq) > 0 ) {
      @db_query("update ${dbprefix}members set is_active='1' where nick='$user'");
      $page=temp_replace("content",$msg_file,$page);
      $page=temp_replace("msg",_lang_changes_applied,$page);
      $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back2\">"._lang_click_here."</a>",$page);
      $page=forward("$back",2,$page);

    }
    else {
      $page=temp_replace("content",$msg_file,$page);
      $page=temp_replace("msg",_lang_activation_failed,$page);
      $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back2\">"._lang_click_here."</a>",$page);
      $page=forward("$back",2,$page);
    }
  }
  else
    {
      $page=temp_replace("content",$msg_file,$page);
      $page=temp_replace("msg",_lang_activation_failed,$page);
      $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back2\">"._lang_click_here."</a>",$page);
      $page=forward("$back",2,$page);


    }
} # effect= check
?>
<?
if($effect=="null"){
  $temp_lost=file_get_contents("$temp_dir/lost_pass.html");
  $page=temp_replace("content",$temp_lost,$page);
  $page=temp_replace("username",_lang_nick,$page);
  $page=temp_replace("submit_text",_lang_submit_text,$page);
  $page=temp_replace("mail",_lang_mail,$page);
}


if($effect=="check"){
  $getuser=$_POST['getuser'];
  $getmail=$_POST['getmail'];
  $page=temp_replace("content",$msg_file,$page);
  $qaaa=@db_query("select auth from ${dbprefix}members where nick='$getuser' and mail='$getmail'");
  if(db_num_rows($qaaa) > 0 ) {
    $rastgele=rand()%100000000;

    $new_pass=substr(md5($rastgele),0,15);
    @db_query("update ${dbprefix}members set password='$new_pass' where nick='$getuser' and mail='$getmail' and nick!='beeman'");

    $user_prompt=str_replace("%user%",$getuser,_lang_password_for_user_is);
    $user_prompt=str_replace("%pass%",$rastgele,$user_prompt);
    $url=$_SERVER['SCRIPT_URI']."?module=users";
    $link=str_replace("%url%",$url,_lang_click_to_login);
    // yönetici þifresi alýmý 
    $mailq=db_query("select mail from ${dbprefix}beedon");
    while ($data= db_fetch_row($mailq)) {
      $from=$data[0];
    }

    // Yeni þifre gönder
    echo $rastgele;
    //mail ($getmail, _lang_new_password , "$user_prompt \n $link ","From: $from\r\n");
    $page=temp_replace("msg",_lang_new_pass_sent,$page);
  }
  else
    {
      $page=temp_replace("msg",_lang_pass_change_fail,$page);
    }

  $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back2\">"._lang_click_here."</a>",$page);
  $page=forward("$back",4,$page);

}
?>
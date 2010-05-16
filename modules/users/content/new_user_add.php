<?

include "include/controls.php";
$temp_nuadd=file_get_contents("$temp_dir/msg.html");
$page=temp_replace("content",$temp_nuadd,$page);

if(nicklength($usernick)){
  $errormsg=$errormsg.nicklength($usernick)."<br>";
  $errors++;
}



if(nick_exists($usernick)){
  $errormsg=$errormsg.nick_exists($usernick)."<br>";
  $errors++;
}


if(passlength($userpassword)){
  $errormsg=$errormsg.passlength($userpassword)."<br>";
  $errors++;
}

if(email_control($usermail)){
  $errormsg=$errormsg.email_control($usermail)."<br>";
  $errors++;
}

if($usermail){
  if(mail_exists($usermail)){
    $errormsg=$errormsg.mail_exists($usermail)."<br>";
    $errors++;
  }
}

if(pass_not_same($userpassword,$userpassword_again)){
  $errormsg=$errormsg.pass_not_same($userpassword,$userpassword_again)."<br>";
  $errors++;
}

if($errors!=0){
  $page=temp_replace("msg",$errormsg,$page);
  $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
  $page=forward($back,2,$page);

}
else
{
  $addpass=enc_pass($userpassword);
  if(check_for_activation()=="1") $activation="0";
  else $activation="1";
  $activation_code=md5($addpass);
  $activation_code=substr($activation_code,1,10);
  $dbprefix=$GLOBALS['dbprefix'];
  db_query("insert into ${dbprefix}members (nick, password, auth, theme, mail, language, mail_on, real_name, icq, msn, yahoo, jabber, signature, avatar, location, homepage, is_active, activation_code) values('$usernick', '$addpass', '2', '$usertheme', '$usermail', '$userlang', '$usermail_on', '$userrealname', '$usericq', '$usermsn', '$useryahoo', '$userjabber', '$usersignature', '$useravatar', '$userlocation', '$userhomepage',  '$activation', '$activation_code')");

  $page=temp_replace("msg",_lang_user_added,$page);


  if($activation=="0"){
    $user_prompt=str_replace("%user%",$usernick,_lang_actcode_for_user_is);
    $user_prompt=str_replace("%code%",$activation_code,$user_prompt);
    $url=$_SERVER['SCRIPT_URI']."?module=users&amp;action=activate&amp;user=${usernick}&amp;code=${activation_code}";
    $url=str_replace("&","&amp;",$url);
    $link=str_replace("%url%",$url,_lang_click_to_activate);
    // yönetici þifresi alýmý 
    $mailq=db_query("select mail from ${dbprefix}beedon");
    while ($data= db_fetch_row($mailq)) {
      $from=$data[0];
    }
ob_start();
$headers = 'From: '.$from . "\r\n" .
   'Reply-To: '.$from. "\r\n" .
   'X-Mailer: PHP/' . phpversion();
    // kiþiye aktivasyon kodu gönder
    mail ($usermail, _lang_activation_code , "$user_prompt \n $link ",$headers);
    $page=temp_replace("if_not_forward",_lang_activation_code_sent,$page);
    echo $activation_code;
  }

  else {
    $page=temp_replace("if_not_forward","",$page);

  }



}

?>

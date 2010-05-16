<?
include "include/controls.php";
$oldmail=$GLOBALS['mail'];

$error_file=file_get_contents("$temp_dir/msg.html");
$oldpass=$GLOBALS['bee_pass_hash'];
$nick=htmlspecialchars($_POST['nick']);
$password=htmlspecialchars($_POST['password']);
$password_again=htmlspecialchars($_POST['password_again']);
$theme=htmlspecialchars($_POST['theme']);
$usermail=htmlspecialchars($_POST['mail']);
$lang=htmlspecialchars($_POST['lang']);
$mail_on=htmlspecialchars($_POST['mail_on']);
$realname=htmlspecialchars($_POST['realname']);
$icq=htmlspecialchars($_POST['icq']);
$msn=htmlspecialchars($_POST['msn']);
$yahoo=htmlspecialchars($_POST['yahoo']);
$jabber=htmlspecialchars($_POST['jabber']);
$signature=htmlspecialchars($_POST['signature']);
$avatar=htmlspecialchars($_POST['avatar']);
$location=htmlspecialchars($_POST['location']);
$homepage=htmlspecialchars($_POST['homepage']);

$errors=0;

if($mail_on=="on") $mail_on="1";
else $mail_on="0";

if(nicklength($nick)){
  $errormsg=$errormsg.nicklength($nick)."<br>";
  $errors++;
}



if(email_control($usermail)){
  $errormsg=$errormsg.email_control($usermail)."<br>";
  $errors++;
}

if($usermail!=$oldmail){
  if(mail_exists($usermail)){
    $errormsg=$errormsg.mail_exists($usermail)."<br>";
    $errors++;
  }
}










if($password){
  if(pass_not_same($password,$password_again)){
    $errormsg=$errormsg.pass_not_same($password,$password_again)."<br>";
    $errors++;
  }
  if(passlength($password)){
    $errormsg=$errormsg.passlength($password)."<br>";
    $errors++;
  }
}


if((!$password) AND (!$password_again)) {
  $newpass=$oldpass;
}
else
$newpass=enc_pass($password);


if($errors==0) {

  @db_query("update ${dbprefix}members set nick='$nick', password='$newpass', theme='$theme', mail='$usermail', language='$lang', mail_on='$mail_on', real_name='$realname', icq='$icq', msn='$msn', yahoo='$yahoo', jabber='$jabber' , signature='$signature' , avatar='$avatar', location='$location', homepage='$homepage'  where id='$userid'");
  $GLOBALS['bee_name']=$nick;
  $GLOBALS['bee_pass_hash']=$newpass;
  $_SESSION['bee_name']=$nick;
  $_SESSION['bee_pass_hash']=$newpass;
  $page=temp_replace("content",_lang_changes_applied,$page);
}
else
{
  $erfile=file_get_contents("$temp_dir/msg.html");
  $page=temp_replace("content",$erfile,$page);
  $page=temp_replace("msg",$errormsg,$page);
  $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
  $page=forward($back,2,$page);
}

?>
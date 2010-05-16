<?
$user=$GLOBALS['bee_name'];
$pass=$GLOBALS['bee_pass_hash'];

if(!$effect) $effect="null";

if($effect=="null"){
  $nu_temp=file_get_contents("$temp_dir/new_user.html");
  $page=temp_replace("content",$nu_temp,$page);
  include "$content_dir/new_user_null.php";
} # effect = null

if($effect=="add"){
  $usernick=htmlspecialchars($_POST['nick']);
  $usertheme=htmlspecialchars($_POST['theme']);
  $usermail=htmlspecialchars($_POST['mail']);
  $userlang=htmlspecialchars($_POST['lang']);
  $usermail_on=htmlspecialchars($_POST['mail_on']);
  $userpassword=htmlspecialchars($_POST['password']);
  $userpassword_again=htmlspecialchars($_POST['password_again']);
  $userrealname=htmlspecialchars($_POST['realname']);
  $usericq=htmlspecialchars($_POST['icq']);
  $usermsn=htmlspecialchars($_POST['msn']);
  $useryahoo=htmlspecialchars($_POST['yahoo']);
  $userjabber=htmlspecialchars($_POST['jabber']);
  $usersignature=htmlspecialchars($_POST['signature']);
  $useravatar=htmlspecialchars($_POST['avatar']);
  $userlocation=htmlspecialchars($_POST['location']);
  $userhomepage=htmlspecialchars($_POST['homepage']);

  if($usermail_on=="on") $usermail_on="1";
  else $usermail_on="0";

  include "$content_dir/new_user_add.php";



  /*
echo $usernick."<br>".$usertheme."<br>".$usermail."<br>".$userlang."<br>".$usermail_on."<br>".
$userpassword."<br>".$userpassword_again."<br>".$userrealname."<br>".$usericq."<br>".$usermsn."<br>".
$useryahoo."<br>".$userjabber."<br>".$usersignature."<br>".$useravatar."<br>".$userlocation."<br>".$userhomepage."<br>";
  */

} # effect = add



?>
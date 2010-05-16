<?
$user=$GLOBALS['bee_name'];
$pass=$GLOBALS['bee_pass_hash'];

$page=temp_replace("header",_lang_your_account,$page);
$navigation="<a href=\"?module=users&amp;action=your_account&amp;effect=setup\">"._lang_account_setup."</a> | <a href=\"?module=users&amp;action=your_account&amp;effect=messages\">"._lang_account_messages."</a> | <a href=\"?module=users&amp;action=logout\">"._lang_logout."</a>";
$page=temp_replace("navigation",$navigation,$page);
if(!$effect) $effect="null";
//
$account_query=@db_query("select * from ${dbprefix}members where nick='$user' and password='$pass'");
$messages_query=@db_query("select * from ${dbprefix}messages where to_who='$user'");
$unread_messages_query=@db_query("select * from ${dbprefix}messages where to_who='$user' and if_read!='1'");
//
while($data=@db_fetch_row($account_query)) {
  $userid=$data[0];
  $usernick=$data[1];
  $userpass=$data[2];
  $userauth=$data[3];
  $usertheme=$data[4];
  $usermail=$data[5];
  $userlanguage=$data[6];
  $usermail_on=$data[7];
  $userrealname=$data[8];
  $usericq=$data[9];
  $usermsn=$data[10];
  $useryahoo=$data[11];
  $userjabber=$data[12];
  $usersignature=$data[13];
  $useravatar=$data[14];
  $userlocation=$data[15];
  $userhomepage=$data[16];
} # while


if($effect=="null") {
  $num=@db_num_rows($unread_messages_query);
  $msg=_lang_you_welcome." ".$user.",<br>";
  $msg=$msg.str_replace("%num%",$num,_lang_youve_unread_msg);
  $page=temp_replace("content",$msg,$page);
}

if($effect=="setup"){
  $setup_temp=file_get_contents("$temp_dir/setup.html");
  $page=temp_replace("content",$setup_temp,$page);
  include "$content_dir/account_setup.php";
} # effect = setup

if($effect=="setup2"){

  include "$content_dir/account_setup2.php";
} #effect = setup2

if($effect=="messages"){
  $do=$_GET['do'];
  //
  $messages_temp=file_get_contents("$temp_dir/messages.html");
  $page=temp_replace("content",$messages_temp,$page);
  $page=temp_replace("send_msg",_lang_send_msg,$page);
  $page=temp_replace("unread_msgs",_lang_unread_msgs,$page);
  $page=temp_replace("read_msgs",_lang_read_msgs,$page);
  $page=temp_replace("sent_msgs",_lang_sent_msgs,$page);

  include "$content_dir/messages.php";

}



?>
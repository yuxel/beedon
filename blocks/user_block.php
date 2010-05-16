<?
$lang=$GLOBALS['lang'];
include "modules/users/lang/$lang.php";
include "lang/$lang.php";
if ($auth<2) {

$user_block=file_get_contents("modules/users/template/blocks/null.html");
$user_block=temp_replace("user",_lang_user_name,$user_block);
$user_block=temp_replace("password",_lang_password,$user_block);
$user_block=temp_replace("remember_me",_lang_remember_me,$user_block);
$user_block=temp_replace("new_user",_lang_new_user,$user_block);
$user_block=temp_replace("submit_text",_lang_submit_text,$user_block);
$user_block=temp_replace("lost_pass",_lang_i_lost_my_pass,$user_block);
}
else {
$user_block=file_get_contents("modules/users/template/blocks/not_null.html");
$user_block=temp_replace("your_acc",_lang_your_account,$user_block);
$user_block=temp_replace("msg",_lang_account_messages,$user_block);
if($auth>=3) {
$auth_msg.="<hr class=\"hrstyle\">";
$auth_msg.="<a href=\"?module=admin&amp;a_module=news\">"._lang_news."</a><br>";
if($auth>3) $auth_msg.="<a href=\"?module=admin\">"._lang_admin_panel."</a><br>";
$auth_msg.="<hr class=\"hrstyle\">";
}
else $auth_msg="";


$user_block=temp_replace("auth",$auth_msg,$user_block);
$user_block=temp_replace("logout",_lang_logout,$user_block);
}


$block=temp_replace("content",$user_block,$block);
?>
<?


if($usermail_on=="1") $mword="checked"; else $mword="";
$mailontext="<input type=\"checkbox\" name=\"mail_on\" $mword>";


$page=temp_replace("header",_lang_your_account,$page);
$page=temp_replace("nick",_lang_nick,$page);
$page=temp_replace("password_info",_lang_if_not_change_pass,$page);

$page=temp_replace("password",_lang_password,$page);
$page=temp_replace("password_again",_lang_password_again,$page);
$page=temp_replace("theme",_lang_theme,$page);
$page=temp_replace("mail",_lang_mail,$page);
$page=temp_replace("language",_lang_language,$page);
$page=temp_replace("mail_on",_lang_mail_on,$page);
$page=temp_replace("realname",_lang_realname,$page);
$page=temp_replace("icq",_lang_icq,$page);
$page=temp_replace("msn",_lang_msn,$page);
$page=temp_replace("yahoo",_lang_yahoo,$page);
$page=temp_replace("jabber",_lang_jabber,$page);
$page=temp_replace("signature",_lang_signature,$page);
$page=temp_replace("avatar",_lang_avatar,$page);
$page=temp_replace("location",_lang_location,$page);
$page=temp_replace("homepage",_lang_homepage,$page);
$page=temp_replace("submit_text",_lang_submit_text,$page);
$page=temp_replace("nickv",$GLOBALS['bee_name'],$page);
$page=temp_replace("list_theme",select_theme(".",$GLOBALS['theme']),$page);
$page=temp_replace("list_languages",select_languages(".",$userlanguage,"0"),$page);
$page=temp_replace("if_mail_on",$mailontext,$page);
$page=temp_replace("realnamev",$userrealname,$page);
$page=temp_replace("mailv",$usermail,$page);
$page=temp_replace("icqv",$usericq,$page);
$page=temp_replace("msnv",$usermsn,$page);
$page=temp_replace("yahoov",$useryahoo,$page);
$page=temp_replace("jabberv",$userjabber,$page);
$page=temp_replace("signaturev",$usersignature,$page);
$page=temp_replace("locationv",$userlocation,$page);
$page=temp_replace("homepagev",$userhomepage,$page);
$page=temp_replace("list_avatar",list_avatars($useravatar),$page);

?>
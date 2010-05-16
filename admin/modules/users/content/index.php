<?
include "modules/users/lang/$lang.php";
$page=temp_replace("content",$start,$page);
//
$page=temp_replace("add_new",_lang_add,$page);
$page=temp_replace("edit",_lang_edit,$page);
$page=temp_replace("active",_lang_activate_user,$page);
if(!$action) $page=temp_replace("content","",$page);
if($action=="add_new") {
    if(!$effect){
        $temp=file_get_contents("$atemp_dir/new_user.html");
        $page=temp_replace("content",$temp,$page);
        $page=temp_replace("header",_lang_new_user,$page);
        $page=temp_replace("nick",_lang_nick,$page);
        $page=temp_replace("theme",_lang_theme,$page);
        $page=temp_replace("language",_lang_language,$page);
        $page=temp_replace("mail",_lang_mail,$page);
        $page=temp_replace("mail_on",_lang_mail_on,$page);
        $page=temp_replace("auth",_lang_auth,$page);
        $page=temp_replace("password",_lang_password,$page);
        $page=temp_replace("password_again",_lang_password_again,$page);
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
        $page=temp_replace("list_theme",select_theme("."),$page);
        $page=temp_replace("list_languages",select_languages(".",$lang,"0"),$page);
        $page=temp_replace("list_avatar",list_avatars($useravatar),$page);
        $page=temp_replace("submit_text",_lang_submit_text,$page);
        $page=temp_replace("select_auth",list_auths("2","0",3),$page);
    } # !effect
    if($effect=="check"){
        include "include/controls.php";
        $temp_nuadd=file_get_contents("$atemp_dir/msg.html");
        $page=temp_replace("content",$temp_nuadd,$page);
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
        $userauth=htmlspecialchars($_POST['nauth']);
        if($usermail_on=="on") $usermail_on="1";
        else $usermail_on="0";

        /*echo $usernick."<br>".$usertheme."<br>".$usermail."<br>".$userlang."<br>".$usermail_on."<br>".$userpassword."<br>".$userpassword_again."<br>".$userrealname."<br>".$usericq."<br>".$usermsn."<br>".$useryahoo."<br>".$userjabber."<br>".$usersignature."<br>".$useravatar."<br>".$userlocation."<br>".$userhomepage."<br>".$userauth;
        */


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
            $activation_code=md5($addpass);
            $activation_code=substr($activation_code,1,10);
            $dbprefix=$GLOBALS['dbprefix'];
            @db_query("insert into ${dbprefix}members (nick, password, auth, theme, mail, language, mail_on, real_name, icq, msn, yahoo, jabber, signature, avatar, location, homepage, is_active, activation_code) values('$usernick', '$addpass', '$userauth', '$usertheme', '$usermail', '$userlang', '$usermail_on', '$userrealname', '$usericq', '$usermsn', '$useryahoo', '$userjabber', '$usersignature', '$useravatar', '$userlocation', '$userhomepage',  '1', '$activation_code')");

            $page=temp_replace("msg",_lang_user_added,$page);
            $page=temp_replace("if_not_forward","",$page);
            $page=forward($back,2,$page);

        }
    } # effect check
} #action = add_new


if($action=="edit"){
    if(!$effect){
        $mfile=file_get_contents("$atemp_dir/list.html");
        $quser=@db_query("select nick,id from ${dbprefix}members where is_active='1' and nick!='beeman'");
        while ($data=@db_fetch_row($quser)){
            $nickname=$nickname.$data[0]."<br>";
            $delete=$delete."<a href=\"?module=admin&amp;a_module=users&amp;action=edit&amp;effect=delete&amp;id=$data[1]\">"._lang_delete."</a><br>";
            $edit=$edit."<a href=\"?module=admin&amp;a_module=users&amp;action=edit&amp;effect=edit&amp;id=$data[1]\">"._lang_edit."</a><br>";
            $spacer=$spacer."&gt;<br>";
        } # while
        $page=temp_replace("content","<br>".$mfile,$page);
        $page=temp_replace("user",$nickname,$page);
        $page=temp_replace("spacer",$spacer,$page);
        $page=temp_replace("delete",$delete,$page);
        $page=temp_replace("edit",$edit,$page);
    } #!effect




    if($effect=="delete"){
        $id=(int) $_GET['id'];
        $usq=@db_query("select id,auth,nick from ${dbprefix}members where id='$id'");
        if(@db_num_rows($usq) < 1) {
            $mtemp=file_get_contents("$atemp_dir/msg.html");
            $page=temp_replace("content",$mtemp,$page);
            $page=temp_replace("msg",_lang_user_not_exists,$page);
            $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back2\">"._lang_click_here."</a>",$page);
            $page=forward("$back",2,$page);
        }

        else{
            while ($data=@db_fetch_row($usq)) {
                $nid=$data[0];
                $nauth=$data[1];
                $nnick=$data[2];
            } # while
            $bee_name=$GLOBALS['bee_name'];
            if($auth<$nauth) $page=temp_replace("content",_lang_permission_denied_on_action,$page);
            if(strtolower($nnick)==strtolower($bee_name)) $page=temp_replace("content",_lang_you_cannot_delete_your_account,$page);
            else
            {
                @db_query("delete from ${dbprefix}members where id='$id'");
                $page=temp_replace("content",_lang_user_deleted,$page);
            } # else
        } #else


    } #effect= delete


    if($effect=="edit"){
        include "admin/modules/users/content/edit.php";
    } #effect= edit

    if($effect=="checkedit"){
        include "admin/modules/users/content/checkedit.php";

    }


} #action = edit

if($action=="activate"){
    if(!$effect){

        $mfile=file_get_contents("$atemp_dir/activate.html");

        $quser=@db_query("select nick,id from ${dbprefix}members where is_active!='1' and nick!='beeman'");
        if(@db_num_rows($quser) < 1) {
            $msgfile=file_get_contents("$atemp_dir/msg.html");
            $page=temp_replace("content","<br>".$msgfile,$page);
            $page=temp_replace("msg",_lang_no_user_to_activate,$page);
            $page=temp_replace("if_not_forward","",$page);

        }
        else{
            while ($data=@db_fetch_row($quser)){
                $nickname=$nickname.$data[0]."<br>";
                $delete=$delete."<a href=\"?module=admin&amp;a_module=users&amp;action=edit&amp;effect=delete&amp;id=$data[1]\">"._lang_delete."</a><br>";
                $edit=$edit."<a href=\"?module=admin&amp;a_module=users&amp;action=edit&amp;effect=edit&amp;id=$data[1]\">"._lang_edit."</a><br>";
                $activate=$activate."<a href=\"?module=admin&a_module=users&action=activate&effect=act&id=$data[1]\">"._lang_activate."</a><br>";

                $spacer=$spacer."&gt;<br>";
            } # while
            $page=temp_replace("content","<br>".$mfile,$page);
            $page=temp_replace("user",$nickname,$page);
            $page=temp_replace("spacer",$spacer,$page);
            $page=temp_replace("delete",$delete,$page);
            $page=temp_replace("edit",$edit,$page);
            $page=temp_replace("activate",$activate,$page);
        }
    } #!effect
    if($effect="act"){
        $gid=(int) $_GET['id'];
        if($gid) {
            $msgfile=file_get_contents("$atemp_dir/msg.html");
            $page=temp_replace("content",$msgfile,$page);
            @db_query("update ${dbprefix}members set is_active='1' where id='$gid'");
            $page=temp_replace("msg",_lang_user_activated,$page);
            $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back2\">"._lang_click_here."</a>",$page);
            $page=forward("$back",2,$page);
        }
    } #effect=Act

} #action=activate


?>
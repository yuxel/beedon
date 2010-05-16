<?
global $onlinemembers;
if($user=="beeman") {
  $msg_temp=file_get_contents("$temp_dir/msg.html");
  $page=temp_replace("content",$msg_temp,$page);
  $page=temp_replace("msg",_lang_this_user_forbidden,$page);
  $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back2\">"._lang_click_here."</a>",$page);
  $page=forward("$back",2,$page);
}
else{

$userx=db_query("select * from ${dbprefix}members where nick='$user' and is_active='1'");
if(db_num_rows($userx) > 0 ) {

  while ($data= db_fetch_row($userx)) {
    $nick=$data[1];
    $uauth=$data[3];
    $mail=$data[5];
    $mail_on=$data[7];
    $real_name=$data[8];
    $icq=$data[9];
    $msn=$data[10];
    $yahoo=$data[11];
    $jabber=$data[12];
    $signature=$data[13];
    $avatar=$data[14];
    $location=$data[15];
    $homepage=$data[16];
  }
  $temp_info=file_get_contents("$temp_dir/info.html");
  $page=temp_replace("content","<br>".$temp_info,$page);
  //

  switch($uauth){
  case 1: $nauth=_lang_null_user;break;
  case 2: $nauth=_lang_normal_user;break;
  case 3: $nauth=_lang_editor;break;
  case 4: $nauth=_lang_admin;break;
  }
  $im_images="modules/users/image";
  $nicq="<img src=\"$im_images/icq.png\" alt=\"\">";
  $nyahoo="<img src=\"$im_images/yahoo.png\" alt=\"\">";
  $njabber="<img src=\"$im_images/jabber.png\" alt=\"\">";
  $nmsn="<img src=\"$im_images/msn.png\" alt=\"\">";
 // son ziyaret zamanýný öðren 
$last_seen=db_query("select time from ${dbprefix}stats where nick='$user' order by stid desc limit 1");
while($seen=db_fetch_row($last_seen)) $seentime=$seen[0];
  // kullanýcý online mý offline mý ?
  $statustext=_lang_offline;
  foreach($onlinemembers as $searchforstatus) {
  if(strtolower($searchforstatus)==strtolower($user)) $statustext=_lang_online;
  }

$profile_countq=db_query("select stid from ${dbprefix}stats where page like '%info%user%$user' group by sessionid;");
$profile_views=db_num_rows($profile_countq);

  $info_text=str_replace("%user%",$nick,_lang_info_for_user);
  $page=temp_replace("info_for_user",$info_text,$page);
  $page=temp_replace("name",_lang_name,$page);
  $page=temp_replace("auth",_lang_auth,$page);
  $page=temp_replace("mail",_lang_mail,$page);
  $page=temp_replace("profile_views",_lang_profile_views,$page);
  $page=temp_replace("num_profile_views",$profile_views,$page);
  $page=temp_replace("location",_lang_location,$page);
  $page=temp_replace("homepage",_lang_homepage,$page);
  $page=temp_replace("uname",$real_name,$page);
  $page=temp_replace("uauth",$nauth,$page);
  $page=temp_replace("ulocation",$location,$page);
  $page=temp_replace("uhomepage",$homepage,$page);
  $page=temp_replace("last_seen",_lang_last_seen,$page);
  $page=temp_replace("seen_date",$seentime,$page);
  $page=temp_replace("usersstatus",_lang_status,$page);
  $page=temp_replace("status",$statustext,$page);
    
  $page=temp_replace("avatar","<img src=\"image/avatar/$avatar\" alt=\"\">",$page);


  if($signature) $page=temp_replace("signature","`".$signature."`",$page);
  else $page=temp_replace("signature","",$page);



  if($icq) {
    $page=temp_replace("icq",$nicq,$page);
    $page=temp_replace("icqn",$icq,$page);
  }
  else
    {
      $page=temp_replace("icq","",$page);
      $page=temp_replace("icqn","",$page);
    }

  if($yahoo) {
    $page=temp_replace("yahoo",$nyahoo,$page);
    $page=temp_replace("yahoon",$yahoo,$page);
  }
  else
    {
      $page=temp_replace("yahoo","",$page);
      $page=temp_replace("yahoon","",$page);
    }



  if($msn) {
    $page=temp_replace("msn",$nmsn,$page);
    $page=temp_replace("msnn",$msn,$page);
  }
  else
    {
      $page=temp_replace("msn","",$page);
      $page=temp_replace("msnn","",$page);


    }


  if($jabber) {
    $page=temp_replace("jabber",$njabber,$page);
    $page=temp_replace("jabbern",$jabber,$page);
  }
  else
    {
      $page=temp_replace("jabber","",$page);
      $page=temp_replace("jabbern","",$page);
    }



  if($mail_on!="0") $page=temp_replace("umail",$mail,$page);
  else $page=temp_replace("umail",_lang_hidden,$page);




}
else
{
  $msg_temp=file_get_contents("$temp_dir/msg.html");
  $page=temp_replace("content",$msg_temp,$page);
  $page=temp_replace("msg",_lang_user_not_exists,$page);
  $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back2\">"._lang_click_here."</a>",$page);
  $page=forward("$back",2,$page);

}
}
?>
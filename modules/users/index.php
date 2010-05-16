<?
include "modules/$module/lang/$lang.php";
$msg_file=file_get_contents("$temp_dir/msg.html");
$module_temp=file_get_contents("$temp_dir/start.html");
$page=temp_replace("module",$module_temp,$page);

if(!$action) 
{
  if($auth<2) $action="null";
  else $action="your_account";
}
if($action=="null"){
  if($auth<2){
    $action_temp=file_get_contents("$temp_dir/$action.html");
    $page=temp_replace("content",$action_temp,$page);
    include "$content_dir/$action.php";
  }
  else
    {
      $page=temp_replace("content",$msg_file,$page);
      $page=temp_replace("msg",_lang_alrady_logged_in,$page);
      $page=temp_replace("if_not_forward","",$page);

    } #else
	}


if($action=="login"){
  $username=$_POST['username'];
  $password=$_POST['password'];
  $remember_me=$_POST['remember_me'];
  if($remember_me=="on") $remember_me=1; else $remember_me=0;
  //
  $username=htmlspecialchars($username);
  $password=htmlspecialchars($password);
  $password=enc_pass($password);
  $result = db_query("SELECT auth from ${dbprefix}members where nick='$username' and password='$password' and is_active='1'");
  while ($query_data = db_fetch_row($result)) {
    $xauth=$query_data[0];
  }
  if($xauth>1) {
    //baþarýlý giriþ
    if($remember_me==1) {$_SESSION['bee_remember_me']=1;}
    $_SESSION['bee_name']=$username;
    $_SESSION['bee_pass_hash']=$password;
    $page=temp_replace("content",$msg_file,$page);
    $page=temp_replace("msg",_lang_login_success,$page);
    $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"?module=users&amp;action=your_account\">"._lang_click_here."</a>",$page);
    $page=forward("?module=users&action=your_account",2,$page);
  }
  else{
    //hatalý giriþ
    $page=temp_replace("content",$msg_file,$page);
    $page=temp_replace("msg",_lang_login_fail,$page);
    $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"?module=users&amp;action=null\">"._lang_click_here."</a>",$page);
    $page=forward("?module=users&action=null",2,$page);
  } # else
      } #action = login 


      if($action=="your_account"){
	if($auth<2){
	  $page=temp_replace("content",$msg_file,$page);
	  $page=temp_replace("msg",_lang_permission_denied,$page);
	  $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"?module=users&amp;action=null\">"._lang_click_here."</a>",$page);
	  $page=forward("?module=users&action=null",2,$page);
	}#if auth
	   else
	     {
	       $action_temp=file_get_contents("$temp_dir/$action.html");
	       $page=temp_replace("content",$action_temp,$page);
	       include "$content_dir/$action.php";
	     } #else
		 } #action = your_account

		 if($action=="logout"){
		   $_SESSION['bee_name']="beeman";
		   $_SESSION['bee_pass_hash']="";
		   $_SESSION['bee_remember_me']="0";
		   $GLOBALS['bee_name']="beeman";
		   $GLOBALS['bee_pass_hash']="";
		   $GLOBALS['bee_remember_me']="0";

		   $page=temp_replace("content",$msg_file,$page);
		   $page=temp_replace("msg",_lang_goodbye,$page);
		   $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
		   $page=forward(".",2,$page);
		 } #if


		 if($action=="new_user"){
		   include "$content_dir/new_user.php";
		 } # action = new_user


		 if($action=="activate"){
		   $msg_file=file_get_contents("$temp_dir/msg.html");

		   $user=$_GET['user'];
		   $code=$_GET['code'];

		   if(($user) and ($code)) {
		     $actq=@db_query("select * from ${dbprefix}members where nick='$user' and activation_code='$code'");

		     $page=temp_replace("content",$msg_file,$page);
		     if(db_num_rows($actq) > 0 ) {
		       @db_query("update ${dbprefix}members set is_active='1'");
		       $page=temp_replace("content",$msg_file,$page);
		       $page=temp_replace("msg",_lang_changes_applied,$page);
		       $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
		       $page=forward(".",2,$page);

		     }
		     else {
		       $page=temp_replace("content",$msg_file,$page);
		       $page=temp_replace("msg",_lang_activation_failed,$page);
		       $page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
		       $page=forward(".",2,$page);
		     }

		   }
		   else if(!$effect) $effect="null";
		   include "$content_dir/activate.php";

		 } #action = activate


		 if($action=="lost_pass"){
		   $msg_file=file_get_contents("$temp_dir/msg.html");
		   $user=$_POST['user'];
		   $umail=$_POST['umail'];
		   if(!$effect) $effect="null";

		   include "$content_dir/lost_pass.php";
		 } # action = lost_pass

		 if($action=="info"){
		   $user=$_GET['user'];
		   include "$content_dir/info.php";
		 } #action = lost_pass


		 if($action=="list"){
		   include "$content_dir/list.php";

		 }

?>
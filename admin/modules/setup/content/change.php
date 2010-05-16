<?
$msgs=file_get_contents("$mtemp_dir/msg.html");
$page=temp_replace("content",$msgs,$page);
$newowner=htmlspecialchars($_POST['owner']);
$newmail=htmlspecialchars($_POST['smail']);
$newtitle=htmlspecialchars($_POST['stitle']);
$newslogan=htmlspecialchars($_POST['sslogan']);
$newfooter=htmlspecialchars($_POST['sfooter']);
$newcharset=htmlspecialchars($_POST['scharset']);
$newday=htmlspecialchars($_POST['sday']);
$newmonth=htmlspecialchars($_POST['smonth']);
$newyear=htmlspecialchars($_POST['syear']);
$newtheme=htmlspecialchars($_POST['theme']);
$newlang=htmlspecialchars($_POST['lang']);
$newwantact=htmlspecialchars($_POST['wantact']);

$fdate=$newyear."-".$newmonth."-".$newday;

if($newwantact=="on") $new_act=1;
else $new_act=0;
@db_query("update ${dbprefix}beedon set admin='$newowner', mail='$newmail', title='$newtitle',slogan='$newslogan', footer='$newfooter', charset='$newcharset', theme='$newtheme', lang='$newlang', startdate='$fdate', want_activation='$new_act'");
@db_query("update ${dbprefix}members set theme='$newtheme', language='$newlang' where nick='beeman'");
$page=temp_replace("msg",_lang_changes_applied,$page);
$page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
$page=forward($back,2,$page);
?> 

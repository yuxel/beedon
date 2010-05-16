<?
$comment_on=$_POST['comment_yes_no'];
$header=$_POST['startheader'];
$content=htmlspecialchars($_POST['starttext']);
$module_on=$_POST['module_yes_no'];
$module=$_POST['which_module'];

@db_query("update ${dbprefix}start_page set comment_on='$comment_on', header='$header', content='$content', module_on='$module_on' , module='$module'");

$page=temp_replace("content",_lang_changes_applied."<br>"._lang_if_not_forward." <a href=\"$back\">"._lang_click_here."</a>",$page);
$page=forward($back,2,$page);
?> 

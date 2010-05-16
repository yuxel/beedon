<?
global $sitehost,$comment_on,$range;
$cid=(int)$_GET['cid'];  //sayfa numarasý

if($cid){
$start=($pno-1)*$range;  //mysql limit baþlangýcý
$totq=@db_query("select cid,newsid from ${dbprefix}news_comments where cid='$cid'");
while($data = db_fetch_row($totq)){
$url="?module=news&action=show_id&id=$data[1]#$data[0]";
}
header("Location: ".$url);
exit;
}
else
{
$page=temp_replace("module","<center>"._lang_no_such_comment."</center>",$page);

}
?>

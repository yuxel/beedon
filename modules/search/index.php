<?
/*---------------------
Arama modülü
--------------------*/

include "modules/$module/include/functions.php";

$msg_file=file_get_contents("$temp_dir/msg.html");
$word=$_POST['word'];
$modulesToSearch=$_POST['modules_to_search'];


$topq=@db_query("select * from ${dbprefix}search where is_active='1'");
$numSearchModules=db_num_rows($topq);


if($numSearchModules<1){

$page=temp_replace("module",$msg_file,$page);
$page=temp_replace("msg",_lang_missin_search_configuration,$page);
$page=temp_replace("if_not_forward","",$page);
}
else
{
$show=file_get_contents("$temp_dir/show.html");
$page=temp_replace("module",$show,$page);
$page=temp_replace("search",_lang_search,$page);
$page=temp_replace("searchit_text",_lang_search_it,$page);


while($data=@db_fetch_row($topq)){
$checkText="";
if($data[8]==1) $checkText="checked";
$radio_buttons.="<input type=\"checkbox\" name=\"module$data[0]\" $checkText>$data[1] &nbsp;";
$lastEntryNo=$data[0];
}

$page=temp_replace("checkboxes",$radio_buttons,$page);

if(!$word) $page=temp_replace("search_results","",$page);
else {


for($i=1;$i<=$lastEntryNo;$i++){
$comingFromPost="module$i";
if($_POST[$comingFromPost] == "on") {
$search_results.=searchFromTable($i,$word);
}

}


$page=temp_replace("search_results",$search_results,$page);
}




} #else

?>

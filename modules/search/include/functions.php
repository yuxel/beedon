<?
function searchFromTable($sid,$searchString){
global $dbprefix,$temp_dir;

$topq=@db_query("select * from ${dbprefix}search where is_active='1' and sid='$sid'");
while($data=@db_fetch_row($topq)){
$header=$data[1];
$table_name=$data[2];
$identifier=$data[3];
$header_field=$data[4];
$fields_to_search=$data[5];
$url_to_go=$data[6];
}


$exp=explode(",",$fields_to_search);
for($i=0;$i<count($exp)-1;$i++){
$likeString.="$exp[$i] like '%$searchString%' OR ";
}



$searchQuery=db_query("select $identifier,$header_field from $table_name where $likeString $header_field like '' order by $identifier desc");
//echo ("select $identifier,$header_field from $table_name where $likeString $header_field like '' ");

if(db_num_rows($searchQuery)<1){

$results=file_get_contents("$temp_dir/results.html");

$results=temp_replace("group_header",$header,$results);

$results=temp_replace("found_item",_lang_no_search_results,$results);
return $results.="<hr class=\"hrstyle\">";

}
else{

while ($datax=@db_fetch_row($searchQuery)){
$url=str_replace("%identifier%",$datax[0],$url_to_go);
$foundItem.="<a href=\"$url\">$datax[1]</a><br>";
} #while


$results=file_get_contents("$temp_dir/results.html");

$results=temp_replace("group_header",$header,$results);

$results=temp_replace("found_item",$foundItem,$results);
return $results.="<hr class=\"hrstyle\">";
}
} #function
?> 

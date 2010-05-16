<?

global $dbname,$dbprefix;


function listSelectFieldsFromArray($fieldArray,$numFields,$multiple=0){
$multipleText="";
if($multiple==1) $multipleText="MULTIPLE";

$returnVal="<select size=$numFields name=\"fields_to_search[]\" $multipleText>\n";
for ($i=0; $i<$numFields; $i++) {
     $optField=$fieldArray[$i];
     $returnVal.="<option value=\"$optField\"> $optField";
}
return $returnVal.="</select>\n";
}

function listRadioFieldsFromArray($fieldArray,$name,$numFields){


for ($i=0; $i<$numFields; $i++) {
     $optField=$fieldArray[$i];
     $returnVal.="<input type=\"radio\" name=\"$name\" value=\"$optField\">$optField<br>";
}
return $returnVal;
}

if(!$effect)  //tablolarý listele
{
$add=file_get_contents("$mtemp_dir/add.html");
$page=temp_replace("content",$add,$page);

$searchForTable=@db_list_tables($dbname);
while ($xrow = @db_fetch_row($searchForTable)) {
if(search_string($dbprefix,$xrow[0]))
{
$fieldName=substr($xrow[0],strlen($dbprefix),strlen($xrow[0]));
$listTables.="<input type=\"radio\" name=\"table\" value=\"$xrow[0]\">$fieldName<br>";
} #if
} #while

$listTables.="<center><input type=\"submit\" value=\""._lang_submit_text."\"></center>";

$page=temp_replace("list_tables",$listTables,$page);

} #!effect

if($effect=="add_module"){

$do=$_GET['do'];
$table=htmlspecialchars($_POST['table']);

$fields = @db_list_fields($dbname, $table);
$NumFields = @db_num_fields($fields);

for ($i=0; $i<$NumFields; $i++) {
     $fieldNames[]=db_field_name($fields, $i);
}

if(!$do) {

$add_module=file_get_contents("$mtemp_dir/add_module.html");
$page=temp_replace("content",$add_module,$page);
$page=temp_replace("list_radio",listRadioFieldsFromArray($fieldNames,"identifier_field",$NumFields),$page);
$page=temp_replace("list_radio_headers",listRadioFieldsFromArray($fieldNames,"find_header",$NumFields),$page);
$page=temp_replace("list_select",listSelectFieldsFromArray($fieldNames,$NumFields,"1"),$page);
$page=temp_replace("info_text",_lang_search_info,$page);
$page=temp_replace("identifier",_lang_identifier,$page);
$page=temp_replace("group_header",_lang_group_header,$page);
$page=temp_replace("fields_to_search",_lang_fields_to_search,$page);
$page=temp_replace("url_to_go",_lang_url_to_go,$page);
$page=temp_replace("submit_text",_lang_submit_text,$page);
$page=temp_replace("find_header",_lang_header,$page);
$page=temp_replace("table_name",$table,$page);
$page=temp_replace("","",$page);


//$page=temp_replace("content",listRadioFieldsFromArray($fieldNames,"hm",$NumFields,"1"),$page);

} #!$do
if($do=="add_it"){
$identifier=htmlspecialchars($_POST['identifier_field']);
$group_header=htmlspecialchars($_POST['group_header']);
$find_header=htmlspecialchars($_POST['find_header']);
$fieldsToSearch=$_POST['fields_to_search'];
$url_to_go=htmlspecialchars($_POST['url_to_go']);

if((strlen($identifier)<1) OR strlen($group_header)<1 OR strlen($find_header)<1 OR strlen($url_to_go)<1 OR count($fieldsToSearch)<1) {
$page=temp_replace("content",$msgfile,$page);
$page=temp_replace("msg",_lang_fill_all_fields,$page);
$page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"?module=admin&amp;a_module=search&amp;action=add\">"._lang_click_here."</a>",$page);
$page=forward("?module=admin&amp;a_module=search&amp;action=add",2,$page);
}
else{

$i=0; 
while($i<count($fieldsToSearch)){ 
    $fieldsQuery.=$fieldsToSearch[$i].","; 
    $i=$i+1; 
}

db_query("insert into ${dbprefix}search (header,table_name,identifier,header_field, fields_to_search, url_to_go,is_active,is_checked) values ('$group_header','$table','$identifier','$find_header','$fieldsQuery','$url_to_go','1','1')");
$page=temp_replace("content",$msgfile,$page);
$page=temp_replace("msg",_lang_search_added,$page);
$page=temp_replace("if_not_forward",_lang_if_not_forward." <a href=\"?module=admin&amp;a_module=search&amp;action=add\">"._lang_click_here."</a>",$page);
$page=forward("?module=admin&amp;a_module=search&amp;action=add",2,$page);

} #else




} #$do=add_it


}



?> 

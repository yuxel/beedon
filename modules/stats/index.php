<?
global $dbprefix;
$msg_file=file_get_contents("$temp_dir/msg.html");
$module_temp=file_get_contents("$temp_dir/start.html");
$page=temp_replace("module",$module_temp,$page);

$page=temp_replace("text_browser_stats",_lang_browser_stats,$page);
$page=temp_replace("text_os_stats",_lang_os_stats,$page);
$page=temp_replace("text_page_hits",_lang_page_hits,$page);
$tothit=str_replace("%hit",db_num_rows(db_query("select distinct(sessionid) from ${dbprefix}stats")),_lang_total_hit);

$page=temp_replace("total_hit",$tothit,$page);

$shit[]="";
// sayfa hitleri
/*$pageqx=db_query("select count(*),page from ${dbprefix}stats where page not like '%admin%' and page not like '%ID%' group by page order by page");
while($data=db_fetch_row($pageqx)){
if (!in_array($data[1],$shit)){
$counter++;
$spage[$counter]=$data[1];
$shit[$counter]=$data[0];
}
}

$counter=0;
foreach($spage as $out) {
$counter++;
$page_hit_item=file_get_contents("$temp_dir/list_page_hits_item.html");
$page_hit_item=temp_replace("url",$out,$page_hit_item);
$page_hit_item=temp_replace("page_hit",htmlspecialchars($shit[$counter]),$page_hit_item);
$outpage.=$page_hit_item;

}

$page=temp_replace("page_item",$outpage,$page);
*/

$browsers=array('mozilla'=>'Mozilla','ie'=>'Internet Explorer','safari'=>'Safari','konqueror'=>'Konqueror','opera'=>'Opera','other'=>_lang_other_browser);
$oses=array('nix'=>'Linux/Unix/BSD','windows'=>'Windows','os2'=>'Os/2','mac'=>'Mac OS','beos'=>'BeOS','other'=>_lang_other_os);
$statsxq=db_query("select distinct(sessionid),os,browser from ${dbprefix}stats");
while($data=db_fetch_row($statsxq)){
foreach($browsers as $brows => $er ) {
if($data[2]==$brows) $browsercount[$brows]++;
}
foreach($oses as $os => $es ) {
if($data[1]==$os) $oscount[$os]++;
}
} #while

foreach($oses as $os => $osname){
$os_temp=file_get_contents("$temp_dir/os_item.html");
$osrep=temp_replace("os",$os,$os_temp);
$osrep=temp_replace("os_name",$oses[$os],$osrep);
$osc=0;
if($oscount[$os]) $osc=$oscount[$os];
$osrep=temp_replace("os_hit",$osc,$osrep);
$osout.=$osrep;
} #foreach

foreach($browsers as $brs => $brname){
$browser_temp=file_get_contents("$temp_dir/browser_item.html");
$brstemp=temp_replace("browser",$brs,$browser_temp);
$brstemp=temp_replace("browser_name",$browsers[$brs],$brstemp);
$bsc=0;
if($browsercount[$brs]) $bsc=$browsercount[$brs];
$brstemp=temp_replace("browser_hit",$bsc,$brstemp);
$brsout.=$brstemp;
} #foreach



//os istatitstikleri

$page=temp_replace("browser_item",$brsout,$page);
$page=temp_replace("os_item",$osout,$page);
?>

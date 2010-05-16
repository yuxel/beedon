<?
header('Content-Type: text/xml; charset=utf-8');

global $sitehost,$charset,$slogan,$lang,$title,$dbprefix,$module;
$rss_temp="$temp_dir/rss/";
//
$main=file_get_contents("$rss_temp/main.html");
$main=temp_replace("title",htmlspecialchars($title),$main);
$main=temp_replace("host",$sitehost,$main);
$main=temp_replace("slogan",$slogan,$main);
$main=temp_replace("lang",$lang,$main);

$newsq=@db_query("select * from ${dbprefix}news where editor is not null order by nid desc limit 10");

while($data=db_fetch_row($newsq)){
  $ncontent=$data[2];
  

$splitTag="<!--split-->";

if(search_string($splitTag,$data[2]))  {
      $xcontent=explode($splitTag,$data[2]); 
      $ncontent=$xcontent[0]."\n";
      }

  $item=file_get_contents("$rss_temp/item.html");
  $link="$sitehost?module=news&action=show_id&id=$data[0]";
 $xitem=temp_replace("header",$data[1],$item);
 $xitem=temp_replace("link",htmlspecialchars($link),$xitem);
 $xitem=temp_replace("content",htmlspecialchars(to_html($ncontent)),$xitem);
 $itemout.=$xitem."\n";
} #while

$main=temp_replace("item",$itemout,$main);

echo iconv("ISO-8859-9","UTF-8",$main);
exit;

?>

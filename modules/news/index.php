<?
/*---------------------
haber mod�l�
--------------------*/
global $comment_on,$range;
include "modules/$module/include/functions.php";
global $news_start_temp,$news_show_id_temp,$news_comment_temp,$topics_image,$temp_dir;
//temp_dir include/page_items.php'de $temp_dir="modules/$module/template"; olarak belirlendi
$msg_file=file_get_contents("$temp_dir/msg.html");
$topics_image="image/topics/";  //konular�n resimleri


$numq=@db_query("select * from ${dbprefix}news_setup");  //haber �zelliklerli
while($dt=db_fetch_row($numq)){
 $range=$dt[0]; 	// bir sayfada ka� haber olsun
  $comment_on=$dt[1];
  //$comment_type=$dt[2];
} #while



//bu dosyalar haberlerin ana sayfada ve tek olarak g�sterimi i�in
//bunlar tema ile geliyor ancak e�er tema ile gelmezse bunlar� kullan
if(!file_exists($news_start_temp)) $news_start_temp="$temp_dir/start.html";
if(!file_exists($news_show_id_temp)) $news_show_id_temp="$temp_dir/show_id.html";

if(!file_exists($news_comment_temp)) $news_show_comment_temp="$temp_dir/show_comments.html";


//$action'lara g�re dosyalar� y�kle
if(!$action) $action="show";  
$action_temp="modules/$module/content/$action.php";
if($action=="show"){
  include "$action_temp";
}

elseif($action=="send_news"){
  include "$action_temp";
} #action send_news

elseif($action=="send_it"){
  include "$action_temp";
} #action send_news

elseif($action=="preview"){
  include "$action_temp";
} #action send_news

elseif($action=="list_topics"){
  include "$action_temp";
} #action send_news

elseif($action=="archive"){
  include "$action_temp";
} #action send_news


elseif($action=="show_interval"){
  include "$action_temp";
} #action send_news

elseif($action=="show_id"){
  include "$action_temp";
}

elseif($action=="rss"){
  include "$action_temp";
}
elseif($action=="add_comment"){
  include "$action_temp";
}
elseif($action=="show_comment"){
  include "$action_temp";
}

else $page=temp_replace("module",_lang_module_not_exists,$page);  //e�er bilinmeyen bir $action ise


?>

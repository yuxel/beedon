<?
global $dbprefix;
$query=db_query("select count(nid),description,topic from ${dbprefix}news,${dbprefix}news_topics where ${dbprefix}news.topic=${dbprefix}news_topics.tid and editor is not null group by topic");
$num=db_num_rows($query);
if($num>0){
while($data=db_fetch_row($query)){
$topics[]=$data[1];
$topiccount[$data[1]]=$data[0];
$topicid[$data[1]]=$data[2];
} #while

foreach($topics as $tname) {
$tbtemp=file_get_contents("modules/news/template/blocks/topics.html");
$tbout=temp_replace("name",$tname,$tbtemp);
$tbout=temp_replace("id",$topicid[$tname],$tbout);
$tbout=temp_replace("count",$topiccount[$tname],$tbout);
$tout.=$tbout;
}

$tout.="<br><a href=\"?module=news&amp;action=list_topics\">["._lang_topics."]</a><br>";
$block=temp_replace("content",$tout,$block);
}
else
$block=temp_replace("content",_lang_no_news,$block);

?>
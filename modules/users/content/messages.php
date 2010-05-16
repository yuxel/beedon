<?
function list_users(){
  $dbprefix=$GLOBALS['dbprefix'];
  $return="<select name=\"to_who\">";

  $search=@db_query("select nick from ${dbprefix}members where nick!='beeman' and is_active='1'");
  while ($data = @db_fetch_row($search)) {
    $return=$return."<option value=\"$data[0]\">$data[0]";} #while

							      $return=$return."</select>";
  return $return;
}
$time=get_date()." ".get_time();

if(!$do) $do="null";

if($do=="null") $page=temp_replace("content","",$page); 

if($do=="send_msg"){
  $send_temp=file_get_contents("$temp_dir/messages_sent_msg.html");
  $page=temp_replace("content",$send_temp,$page);

  $page=temp_replace("sender",_lang_msg_sender,$page);
  $page=temp_replace("to_who",_lang_msg_to_who,$page);
  $page=temp_replace("time",_lang_time,$page);
  $page=temp_replace("header",_lang_header,$page);
  $page=temp_replace("message",_lang_message,$page);
  $page=temp_replace("submit_text",_lang_submit_text,$page);
  $page=temp_replace("name",$GLOBALS['bee_name'],$page);
  $page=temp_replace("sent_time",$time,$page);
  $page=temp_replace("combo_box_users",list_users(),$page);
} #do = send_msg


if($do=="send_it"){
  $dbprefix=$GLOBALS['dbprefix'];
  $bee_name=$GLOBALS['bee_name'];
  //
  $to_who=htmlspecialchars($_POST['to_who']);
  $header=htmlspecialchars($_POST['msg_header']);
  $content=htmlspecialchars($_POST['msg_text']);
  //
  @db_query("insert into ${dbprefix}messages (from_who,to_who,time,header,content,if_read) values('$bee_name','$to_who','$time','$header' , '$content','0')");
  $page=temp_replace("content",_lang_message_sent,$page);

}


if($do=="unread_msgs"){
  $user=$GLOBALS['bee_name'];
  $unread_messages=@db_query("select * from ${dbprefix}messages where to_who='$user' and if_read!='1' order by mid desc");
  if(db_num_rows($unread_messages) < 1 ) $page=temp_replace("content",_lang_no_messages,$page);
  else
    {
      $return="<div align=\"left\">";
      while ($data = @db_fetch_row($unread_messages)){
	$temp=file_get_contents("$temp_dir/messages_list.html");
	$temp=temp_replace("from",$data[1],$temp);
	$temp=temp_replace("header",$data[4],$temp);
	$temp=temp_replace("id",$data[0],$temp);
	$temp=temp_replace("time",$data[3],$temp);
	$return=$return.$temp."<br>";
      } #while
	  $return=$return."</div>";
      $page=temp_replace("content",$return,$page);
      $page=temp_replace("read_text",_lang_read,$page);
      $page=temp_replace("delete_text",_lang_delete,$page);
    } #else
	}  #unread_msgs


	if($do=="read_msgs"){
	  $user=$GLOBALS['bee_name'];
	  $read_messages=@db_query("select * from ${dbprefix}messages where to_who='$user' and if_read='1' order by mid desc");
	  if(db_num_rows($read_messages) < 1 ) $page=temp_replace("content",_lang_no_messages,$page);
	  else
	    {
	      $return="<div align=\"left\">";
	      while ($data = @db_fetch_row($read_messages)){
		$temp=file_get_contents("$temp_dir/messages_list.html");
		$temp=temp_replace("from",$data[1],$temp);
		$temp=temp_replace("header",$data[4],$temp);
		$temp=temp_replace("id",$data[0],$temp);
		$temp=temp_replace("time",$data[3],$temp);
		$return=$return.$temp."<br>";
	      } #while
		  $return=$return."</div>";
	      $page=temp_replace("content",$return,$page);
	      $page=temp_replace("read_text",_lang_read,$page);
	      $page=temp_replace("delete_text",_lang_delete,$page);

	    } #else
		} #read_msgs




		if($do=="sent_msgs"){
		  $user=$GLOBALS['bee_name'];
		  $sent_messages=@db_query("select * from ${dbprefix}messages where from_who='$user' order by mid desc");
		  $return="<div align=\"left\">";
		  while ($data = @db_fetch_row($sent_messages)){
		    $temp=file_get_contents("$temp_dir/messages_sent_list.html");
		    $temp=temp_replace("to",$data[2],$temp);
		    $temp=temp_replace("header",$data[4],$temp);
		    $temp=temp_replace("id",$data[0],$temp);
		    $temp=temp_replace("time",$data[3],$temp);
		    $return=$return.$temp."<br>";
		  } #while
		      $return=$return."</div>";
		  $page=temp_replace("content",$return,$page);
		  $page=temp_replace("read_text",_lang_read,$page);
		} #read_msgs




		if($do=="read_it"){
		  $id=$_GET['id'];
		  $user=$GLOBALS['bee_name'];
		  $query=@db_query("select * from ${dbprefix}messages where mid='$id' and to_who='$user'");
		  $num_rows=db_num_rows($query);
		  if(!$id) $page=temp_replace("content",_lang_msg_id_not_exists,$page);
		  if($num_rows < 1 ) $page=temp_replace("content",_lang_msg_not_permitted,$page);
		  else
		    {
		      while ($data = db_fetch_row($query)) {


			$temp_read=file_get_contents("$temp_dir/messages_read.html");
			$page=temp_replace("content",$temp_read,$page);
			//
			$page=temp_replace("sender",_lang_sender,$page);
			$page=temp_replace("time",_lang_time,$page);
			$page=temp_replace("sent_time",$data[3],$page);
			$page=temp_replace("header",$data[4],$page);
			$page=temp_replace("message",$data[5],$page);
			$page=temp_replace("name",$data[1],$page);
			$page=temp_replace("delete_text",_lang_delete,$page);
			$page=temp_replace("id",$data[0],$page);

			@db_query("update ${dbprefix}messages set if_read='1' where mid='$data[0]'");
		      } # while
			  } # else
			      } #do = read_it




			      if($do=="delete_it"){
				$id=$_GET['id'];
				$user=$GLOBALS['bee_name'];
				$query=@db_query("select * from ${dbprefix}messages where mid='$id' and to_who='$user'");
				$num_rows=db_num_rows($query);
				if(!$id) $page=temp_replace("content",_lang_msg_id_not_exists,$page);
				if($num_rows < 1 ) {
				  $page=forward($back,"1",$page);
				  $page=temp_replace("content",_lang_msg_not_permitted,$page);}
				else
				  {
				    $page=temp_replace("content",_lang_msg_deleted,$page);
				    @db_query("delete from ${dbprefix}messages where mid='$id'");

				  } # else
				      } #do = read_it
				      ?>
<?
/*------------------
Arþiv modülü
---------------*/


global $dbprefix;
$arcq=@db_query("select distinct(concat(year(time), '-',month(time))) from ${dbprefix}news order by time desc");  
//farklý ay ve yýllarý bul


//onlara göre liste çýkar ve show_interval.php'ye bað gönder
while($data=@db_fetch_row($arcq)){
  $archtemp=file_get_contents("$temp_dir/archive.html");
  $div=explode("-",$data[0]);
  $archtemp=temp_replace("year",$div[0],$archtemp);
  $archtemp=temp_replace("month",return_month_name($div[1]),$archtemp);
  $archtemp=temp_replace("monthid",$div[1],$archtemp);
  $output.=$archtemp."<br>";
}
$page=temp_replace("module",$output,$page);
?>
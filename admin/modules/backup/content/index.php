<?
/*----------------------------
Veritabaný yedekleme modülü
--------------------------*/

global $dbname; //veritabaný adý
$backup_folder="tmp/";  //yedekleme klasörü

if(!$action) {
    if(!is_writeable($backup_folder)) {
        $finish=file_get_contents("$mtemp_dir/not_writeable.html");
        $page=temp_replace("content",$finish,$page);
        $page=temp_replace("info",_lang_backup_write_error,$page);
        $page=temp_replace("extra_info",_lang_backup_error_extra,$page);


    }
    else
    {

        $page=temp_replace("content",$start,$page);
        $page=temp_replace("info_text",_lang_backup_info,$page);
        $page=temp_replace("backup_db",$dbname,$page);
        $page=temp_replace("do_it",_lang_do_backup,$page);
        $compression_text=_lang_compress_backup;
        if ((function_exists('gzopen')) AND (function_exists('gzwrite'))) {  //eðer sunucu sýkýþtýrma destekliyorsa
        //bir checkbox oluþtur
        $page=temp_replace("form_entry",_lang_compress_backup."<br><input type=\"checkbox\" name=\"gz\" checked><br>",$page);
        }
        else
        $page=temp_replace("form_entry","",$page);
    }
} #!action

if($action=="backup") {
    $gz=$_POST['gz'];  //gz al
    $date=get_date();
    $comment_line=str_replace("%dbname",$dbname,_lang_comment_line);
    $comment_line=str_replace("%date",$date,$comment_line);

    $out="--$comment_line\n";  //yorum satýrý
    $tables=db_list_tables($dbname);
    $numoftables=db_num_rows($tables); //veritabanýndaki tablo sayýsýný bul
    for ($a=0;$a<$numoftables;$a++) {  // her tablo için iþlem yap
    $row=db_fetch_row($tables);
    global $dbprefix;
    if(preg_match("/$dbprefix([a-zA-Z0-9_-])+/", $row[0])){
        $tablename=$row[0];
        $res2=db_query("show create table $tablename");
        //her tablo için show create table komutu ile iste
        //bu özellik MySQL 3.23.20 de gelmiþ
        $tmpres = db_fetch_row($res2);
        $out .= $tmpres[1].";";
        $out .= "\n\n";
        $res2=db_query("select * from `$tablename`");  //her field için insert into komutlarýný hazýrla
        $numoffields=db_num_fields($res2);
        $nr=db_num_rows($res2);
        for ($c=0;$c<$nr;$c++){
            $out .= "insert into `$tablename` values (";
            $row=db_fetch_row($res2);
            for ($d=0;$d<$numoffields;$d++) {
                $data=strval($row[$d]);
                $out .="'".addslashes($data)."'";
                if ($d<($numoffields-1)) {
                    $out .=", ";
                }
            }
            $out .=");\n";
        }
    }
    }
    $out .= "";
    $gzwrite_error=0;
    if($gz=="on"){ //eðer sýkýþtýrma varsa sýkýþtýr
    $fname=$backup_folder.$dbname.$date.".sql.gz";
    if(is_writeable($backup_folder)) {
        $zp = gzopen($fname, "w9");
        gzwrite($zp, $out);
        gzclose($zp);
    }
    else $gzwrite_error="1";
    }
    else
    {  //yoksa metin olarak kaydet
    $fname=$backup_folder.$dbname.$date.".sql";
    if(is_writeable($backup_folder)) {
        $fp=fopen($fname, "w");
        fwrite($fp,$out);
        fclose($fp);
    }
    else $gzwrite_error="1";
    }
    if($gzwrite_error!="1") {
        $finish=file_get_contents("$mtemp_dir/finish.html");
        $page=temp_replace("content",$finish,$page);
        $page=temp_replace("info",_lang_backup_success,$page);
        $page=temp_replace("url",$fname,$page);
        $page=temp_replace("download",_lang_download,$page);
    }
    else{
        $finish=file_get_contents("$mtemp_dir/not_writeable.html");
        $page=temp_replace("content",$finish,$page);
        $page=temp_replace("info",_lang_backup_write_error,$page);
        $page=temp_replace("extra_info",_lang_backup_error_extra,$page);


    }

} #action= backup
?>

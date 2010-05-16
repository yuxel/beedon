<?
if(!$action){
    $page=temp_replace("content",$start,$page);
    $page=temp_replace("admin_name",_lang_owner_name,$page);
    $page=temp_replace("site_mail",_lang_site_mail,$page);
    $page=temp_replace("title",_lang_title,$page);
    $page=temp_replace("slogan",_lang_slogan,$page);
    $page=temp_replace("footer",from_html(_lang_footer),$page);
    $page=temp_replace("charset",_lang_charset,$page);
    $page=temp_replace("startdate",_lang_start_date,$page);
    $page=temp_replace("theme",_lang_theme,$page);
    $page=temp_replace("lang",_lang_language,$page);
    $page=temp_replace("want_activation",_lang_want_activation,$page);
    $page=temp_replace("submit",_lang_submit_text,$page);
    #--



    $qbeedon=@db_query("select * from ${dbprefix}beedon");
    while ($data=@db_fetch_row($qbeedon)){
        $page=temp_replace("gname",$data[0],$page);
        $page=temp_replace("gmail",$data[1],$page);
        $page=temp_replace("gtitle",$data[2],$page);
        $page=temp_replace("gslogan",$data[3],$page);
        $page=temp_replace("gfooter",from_html($data[4]),$page);
        $page=temp_replace("gcharset",$data[5],$page);
        $getdatex=$data[6];
        $page=temp_replace("glang",$data[8],$page);
        $getthemex=$data[7];
        $getlangx=$data[8];
        $getactx=$data[9];
    }

    $exdate=explode("-", $getdatex);
    $page=temp_replace("gday",$exdate[2],$page);
    $page=temp_replace("gmonth",$exdate[1],$page);
    $page=temp_replace("gyear",$exdate[0],$page);
    $page=temp_replace("gtheme",select_theme(".",$getthemex),$page);

    if($getactx=="1") $checkboxact="<input type=\"checkbox\" name=\"wantact\" checked>";
    else $checkboxact="<input type=\"checkbox\" name=\"wantact\">";

    $page=temp_replace("want_act",$checkboxact,$page);
    $page=temp_replace("list_lang",select_languages(".",$getlangx,0),$page);

} #!action
if($action=="change")
{
    include "$content_dir/$action.php";

} # action=change
?>
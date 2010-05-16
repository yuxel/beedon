<?
close_db($connect_to_db);  //veritabaný baðlantýsýný kapat
// sayfa üretimi -> Tuðrul Duran
$i = explode(' ', microtime());
$sys['endtime'] = $i[1] + $i[0];
$sys['creationtime'] = round(($sys['endtime'] - $sys['starttime']), 3);
$creation_time=$sys['creationtime'];  //sayfa üretimi
//
$page=temp_replace("creation_time",_lang_page_creation_time." :".$creation_time." "._lang_seconds,$page); //sayfa üretimini yaz
$totalquery=str_replace("%1",$totalquery,_lang_total_query);  //toplam sorgu
$page=temp_replace("totalquery",$totalquery,$page);  //toplam sorguyu yaz
$page=str_replace("&PHPSESSID","&amp;PHPSESSID",$page); //htmlvalidation için
$meta_content="<META name=\"RESOURCE-TYPE\" content=\"DOCUMENT\">
<META name=\"DISTRIBUTION\" content=\"GLOBAL\">
<META name=\"AUTHOR\" content=\"$slogan\">
<META name=\"DESCRIPTION\" content=\"$slogan\">
<META name=\"ROBOTS\" content=\"INDEX, FOLLOW\">
<META name=\"REVISIT-AFTER\" content=\"1 DAYS\">
<META name=\"GENERATOR\" content=\"Beedon - http://www.beedon.org\">\n";


$body_commands="<!-- IE'deki png seffaflik sorunu icin -->\n<!--[if gte IE 5.5000]> <script language=\"JavaScript\"> function correctPNG() /* correctly handle PNG transparency in Win IE 5.5 or higher. */ { for(var i=0; i<document.images.length; i++) { var img = document.images[i]; var imgName = img.src.toUpperCase(); if (imgName.substring(imgName.length-3, imgName.length) == \"PNG\") { var imgID = (img.id) ? \"id='\" + img.id + \"' \" : \"\"; var imgClass = (img.className) ? \"class='\" + img.className + \"' \" : \"\"; var imgTitle = (img.title) ? \"title='\" + img.title + \"' \" : \"title='\" + img.alt + \"' \"; var imgStyle = \"display:inline-block;\" + img.style.cssText; var imgAttribs = img.attributes; for (var j=0; j<imgAttribs.length; j++) { var imgAttrib = imgAttribs[j]; if (imgAttrib.nodeName == \"align\"); { if (imgAttrib.nodeValue == \"left\") imgStyle = \"float:left;\" + imgStyle; if (imgAttrib.nodeValue == \"right\") imgStyle = \"float:right;\" + imgStyle; break; } } var strNewHTML = \"<span \" + imgID + imgClass + imgTitle; strNewHTML += \" style=\\\"\" + \"width:\" + img.width + \"px; height:\" + img.height + \"px;\" + imgStyle + \"\";\"; strNewHTML += \"filter:progid:DXImageTransform.Microsoft.AlphaImageLoader\"; strNewHTML += \"(src=\'\" + img.src + \"\', sizingMethod='scale');\\\"></span>\"; img.outerHTML = strNewHTML; i = i-1; } } } window.attachEvent(\"onload\", correctPNG); </script> <![endif]-->";


$page=str_replace("<!--meta_command-->",$meta_content."\n<!--meta_command-->",$page);
$page=str_replace("<!--body_command-->",$body_commands."\n<!--body_command-->",$page);
/*header('Content-Type: text/html; charset=utf-8');
echo iconv("iso-8859-9",$charset,$page); //sayfayý yaz
*/
echo $page; //sayfayý yazdýr

?>

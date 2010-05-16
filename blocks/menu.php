<?
global $menuitems,$menuurls;
foreach ($menuitems as $menui) {
$menubtemp=file_get_contents("template/menu.html");
$mbout=temp_replace("name",$menui,$menubtemp);
$mbout=temp_replace("url",htmlspecialchars($menuurls[$menui]),$mbout);
$mboutx.=$mbout;
}
$block=temp_replace("content",$mboutx,$block);

?> 

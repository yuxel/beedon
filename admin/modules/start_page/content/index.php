<?
if(!$action) $action="null";
if($action=="null") {
    include "$content_dir/$action.php";
} #action = null


if($action=="update") {
    include "$content_dir/$action.php";


} #action= update
?>  
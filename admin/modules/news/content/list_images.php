<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta content="text/html; charset=iso-8859-1;"
http-equiv="content-type">
<title></title>
</head>
<body>
<?
$tempf=file_get_contents("../template/image_list.html");

$path="../../../../image/topics";
$klasor = @opendir($path);
$counter=1;
$total_count=0;
$msg="<table border=\"0\" style=\"border: 1px dotted #BBB;text-align:center\"><tr>";
while ($dosya = readdir($klasor)) {
    if($dosya == "." || $dosya == ".." || $dosya == "index.php" || $dosya == "index.html")  // .. , . ve index.php listelenmesin
    continue;
    $img="$path/$dosya";

    $td=str_replace("#avatarfile#",$img,$tempf);
    $td=str_replace("#name#",$dosya,$td);
    if($counter<4){
        $msg=$msg."<td>".$td."</td>";
        $total_count++;
    }
    else {
        $msg=$msg."<td>".$td."</td>"."</tr><tr>";
        $counter=0;
        $total_count++;
    }
    $counter++;
}

$modulus=$total_count%4;

if($modulus==0){
    $valid_msg="<td></td>";
}

echo $msg.$valid_msg."</tr></table>";


?>

</body>
</html>
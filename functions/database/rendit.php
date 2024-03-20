<?php
require_once("../functions.php");

$str = $_SERVER['QUERY_STRING']; 
$str=str_replace("m[]=","",$str);
$str=str_replace("&","|",$str);
$strv=explode("|", $str);



$l=count($strv);
for($i=1;$i<$l;$i++)
{
	$sql="Update {$t} set radha=" . $i. " where id=" . $strv[$i];
	echo $sql;
	$conn->query($sql);

}
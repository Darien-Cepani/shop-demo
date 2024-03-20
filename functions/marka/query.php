<?php
require_once('../functions.php');


$c="";
$k="";
$i=0;

if (!$_REQUEST{"id"}) {

foreach ($_POST as $key => $value)  
{ 
    if ($key == 'shtimi') {
        break;    
    } 
if ($key!="id") {	
if ($i==0) {
	$c.="`" . $key . "`";
	$k.= "'" . pastro($value) . "'";
	$i=1;
	} else {
	$c.=",`" . $key . "`";
	$k.=",'" . pastro($value) . "'";		
		}

	
}  
}

	
  	$query = "INSERT INTO marka(";
    $query .= $c;
    $query .= ") VALUES (";
	$query .= $k;
    $query .= ")";
	echo $query;
$conn->query($query);

}else{





foreach ($_POST as $key => $value)  
{ 
    if ($key == 'shtimi') {
        break;   
    } 
	
	if ($key=="id") {
		$copa=" WHERE id = " . pastro($value);
		} else {

if ($value!="************")	{
if ($i==0) {
	$c.="`" . $key . "`='" . pastro($value) . "'";
	$i=1;
	} else {
	$c.=",`" . $key . "`='" . pastro($value) . "'";
		}
}		
		
}

}


//duhet ndryshuar tek te gjithe produktet 
$marka=pastro($_REQUEST["marka"]);
$query="SELECT marka FROM marka WHERE id = {$id}";
$row = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
$markaOld=$row["marka"];

if ($markaOld<>'' && $marka<>'' && $marka!=$markaOld) {
$sql="UPDATE produktet set marka=REPLACE(marka,'{$markaOld}','{$marka}')";

$conn->query($sql);
}

	$query = "UPDATE marka SET ";
    $query .= $c;
    $query .= $copa;


$conn->query($query);
}


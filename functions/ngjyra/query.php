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

	
  	$query = "INSERT INTO ngjyra(";
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
$ngjyra=pastro($_REQUEST["ngjyra"]);
$query="SELECT ngjyra FROM ngjyra WHERE id = {$id}";
$row = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
$ngjyraOld=$row["ngjyra"];

if ($ngjyraOld<>'' && $ngjyra<>'' && $ngjyra!=$ngjyraOld) {
$sql="UPDATE produktet set ngjyra=REPLACE(ngjyra,'{$ngjyraOld}','{$ngjyra}')";

$conn->query($sql);
}

	$query = "UPDATE ngjyra SET ";
    $query .= $c;
    $query .= $copa;


$conn->query($query);
}


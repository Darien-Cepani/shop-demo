<?php
require_once("../functions.php");

$c="";
$k="";
$i=0;

if (!$id) {
foreach ($_POST as $key => $value)  
{ 
    if ($key == 'koleksionform') {
        break;
    } 
    
    if (is_array($value)) {
    	$value=join(",",$value);
    }
    
    
if ($key!="id" && $key!="t") {	
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

  	$query = "INSERT INTO {$t}(";
    $query .= $c;
    $query .= ") VALUES (";
	$query .= $k;
    $query .= ")";
    $conn->query($query);


   }else{


foreach ($_POST as $key => $value)  
{ 
    if ($key != 't') {
 
     if (is_array($value)) {
    	$value=join(",",$value);
    }
 
	if ($key=="id") {
		$copa=" WHERE id = " . pastro($value);
		} else {
	
if ($i==0) {
	$c.="`" . $key . "`='" . pastro($value) . "'";
	$i=1;
	} else {
	$c.=",`" . $key . "`='" . pastro($value) . "'";
		}
}
}
 } 
 
	$query = "UPDATE {$t} SET ";
    $query .= $c;
    $query .= $copa;


$conn->query($query);
}




echo "1";
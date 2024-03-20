<?php
require_once('../functions.php');

$tabela="taskslist";
$i=0;



if (!$id) {
foreach ($_REQUEST as $key => $value)  
{ 
    if ($key == 'shtimi') {
        break; 
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

	
  	$query = "INSERT INTO {$tabela}(";
    $query .= $c;
    $query .= ",agjentiid";
    $query .= ") VALUES (";
	$query .= $k;

	$query .= ",'{$_SESSION["id"]}'";
    $query .= ")";

$conn->query($query);
$id=$conn->lastInsertId();

}else{

foreach ($_REQUEST as $key => $value)  
{ 
    if ($key == 'shtimi') {
        break; 
    } 
	
	if ($key=="id") {
		$copa=" WHERE id = " . pastro($value);
		} else {
		if ($key!="t") {
        if ($i==0) {
	        $c.="`" . $key . "`='" . pastro($value) . "'";
	        $i=1;
	     } else {
	        $c.=",`" . $key . "`='" . pastro($value) . "'";
		 }
		}
		 
}  
}

	$query = "UPDATE {$tabela} SET ";
    $query .= $c;
    $query .= $copa;

$conn->query($query);
}

echo $id;
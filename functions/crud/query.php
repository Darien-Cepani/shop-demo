<?php
require_once('../functions.php');

$tabela=pastro($_REQUEST["t"]);
$i=0;
if (!$id) {
foreach ($_POST as $key => $value)  
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
    $query .= ") VALUES (";
	$query .= $k;
    $query .= ")";
if (k($tabela ."-add")) {
$conn->query($query);
}

}else{

foreach ($_POST as $key => $value)  
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
if (k($tabela ."-edit")) {
$conn->query($query);
}
}
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
    
    $vl=pastro(str_replace('"','″',$value)); 
    
    
if ($key!="id") {	
if ($i==0) {
	$c.="`" . $key . "`";
	$k.= "'" . $vl . "'";
	$i=1;
	} else {
	$c.=",`" . $key . "`";
	$k.=",'" . $vl . "'";		
		}

	
}  
}

	
  	$query = "INSERT INTO dimensione(";
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
	
	
	$vl=pastro(str_replace('"','″',$value)); 
	
	if ($key=="id") {
		$copa=" WHERE id = " . $vl;
		} else {


if ($i==0) {
	$c.="`" . $key . "`='" . $vl . "'";
	$i=1;
		} else {
	$c.=",`" . $key . "`='" . $vl . "'";
		}
}		
		


}


						//duhet ndryshuar tek te gjithe produktet 
						$lloji=pastro($_REQUEST["lloji"]);
						$vlera=pastro($_REQUEST["emri"]);
						$query="SELECT emri FROM dimensione WHERE id = {$id}";
						$row = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
						$vleraOld=$row["emri"];
						if ($vleraOld<>'' && $vlera<>'' && $vlera!=$vleraOld) {
						$sql="UPDATE produktet set {$lloji}=REPLACE({$lloji},'{$vleraOld}','{$vlera}')";
						$conn->query($sql);
						}
						
						

	$query = "UPDATE dimensione SET ";
    $query .= $c;
    $query .= $copa;


$conn->query($query);
}


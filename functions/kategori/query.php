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

	
  	$query = "INSERT INTO kategori(";
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
$kategori=pastro($_REQUEST["kategori"]);
$query="SELECT kategori FROM kategori WHERE id = {$id}";
$row = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
$kategoriOld=$row["kategori"];

if ($kategori<>'' && $kategori!=$kategoriOld) {
$sql="UPDATE produktet set kategoria=REPLACE(kategoria,'{$kategoriOld}','{$kategori}')";
$conn->query($sql);
}

	$query = "UPDATE kategori SET ";
    $query .= $c;
    $query .= $copa;


$conn->query($query);
}


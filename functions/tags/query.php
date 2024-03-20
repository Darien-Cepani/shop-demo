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

	
  	$query = "INSERT INTO tags(";
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
$tag=pastro($_REQUEST["tag"]);
$query="SELECT tag FROM tags WHERE id = {$id}";
$row = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
$tagOld=$row["tag"];

if ($tagOld<>'' && $tag<>'' && $tag!=$tagOld) {
$sql="UPDATE produktet set tags=REPLACE(tags,'{$tagOld}','{$tag}')";
$conn->query($sql);

$sql="UPDATE sizes set tag=REPLACE(tag,'{$tagOld}','{$tag}')";
$conn->query($sql);
}

	$query = "UPDATE tags SET ";
    $query .= $c;
    $query .= $copa;


$conn->query($query);
}


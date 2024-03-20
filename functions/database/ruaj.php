<?php
require_once("../functions.php");

$c="";
$k="";
$i=0;

if ($_POST["cmimiSale"]=="") {$_POST["cmimiSale"]=0;}
if ($_POST["cmimi"]=="") {$_POST["cmimi"]=0;}

if (!$id) {
foreach ($_POST as $key => $value)  
{ 
    if ($key == 'shtimi') {
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


if ($_REQUEST["tags"]!="") {
	$arr=$_REQUEST["tags"];
	foreach($arr as $item) {
	$sql="INSERT IGNORE INTO tags (tag) VALUES ('" . pastro($item) . "')";
	$conn->query($sql);
	}
}

if ($_REQUEST["marka"]!="") {
	$item=pastro($_REQUEST["marka"]);
	$sql="INSERT IGNORE INTO marka (marka) VALUES ('" . pastro($item) . "')";
	$conn->query($sql);
}

if ($_REQUEST["ngjyra"]!="") {
	$arr=$_REQUEST["ngjyra"];
	foreach($arr as $item) {
	$sql="INSERT IGNORE INTO ngjyra (ngjyra) VALUES ('" . pastro($item) . "')";
	$conn->query($sql);
	}
}


echo 1;
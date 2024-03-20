<?php
require_once("../functions.php");

$c="";
$k="";
$i=0;

$query="UPDATE {$t} SET shopName = '{$_REQUEST['shopName']}', logo = '{$_REQUEST['logo']}'";

$conn->query($query);

if($query){
    header('location: ../../parametraDyqan.php');
}
?>
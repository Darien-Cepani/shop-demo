<?php
require_once("../functions.php");

$c="";
$k="";
$i=0;

$hidden=merrvar("hidden");
$id=merrvar("id");

$query="UPDATE {$t} SET hidden = {$hidden} WHERE id = {$id}";

$conn->query($query);
echo $query;
?>
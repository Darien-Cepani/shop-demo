<?php
require_once("../functions.php");

$c="";
$k="";
$i=0;

$query="DELETE FROM {$t} where id={$id}";
$conn->query($query);
echo $query;
?>
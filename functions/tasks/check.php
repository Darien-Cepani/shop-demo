<?php
require_once('../functions.php');

$tabela="taskslist";
$i=0;
$c=merrvar("c");

	$query = "UPDATE {$tabela} SET ";
    $query .= "done={$c},";
    $query .= "doneby={$_SESSION["id"]}";
    $query .= " WHERE id={$id}";

$conn->query($query);
echo $query;
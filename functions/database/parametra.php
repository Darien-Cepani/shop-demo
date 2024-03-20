<?php
require_once("../functions.php");


$_POST=$_REQUEST;

foreach ($_POST as $key => $value)  {
 $value=pastro($value);
 $query = "update parametra set {$key}='{$value}'";
}

echo $query;

$conn->query($query);


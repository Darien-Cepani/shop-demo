<?php
require_once("../functions.php");

$vl=pastro($_REQUEST["vl"]);
$query="UPDATE produktet set kodi='{$vl}' where id={$id}";
$conn->query($query);

?>
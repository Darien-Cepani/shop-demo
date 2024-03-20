<?php
require_once("../functions.php");

$query="UPDATE produktet set shfaq={$j} where id={$id}";
$conn->query($query);

?>
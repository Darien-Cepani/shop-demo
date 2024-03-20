<?php
require_once('../functions.php');
$ids=pastro($_REQUEST["ids"]);
rtrim($ids,",");
$query = "UPDATE koleksionet SET prodIds='{$ids}' where id={$id} ";
$conn->query($query);


